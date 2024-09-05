<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SemiState;
use Illuminate\Http\Request;
use App\Models\Team;
use Exception;
use Google\Service\Batch\Message;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{
    public function index()
    {
        $teams = DB::table('teams')
            ->join('semi_statistics', 'teams.id', '=', 'semi_statistics.id_team')
            ->select('teams.nama as nama', 'semi_statistics.score as score')
            ->get();
        $curState = SemiState::first();

        return view('admin.market', [
            'title' => 'Market',
            'teams' => $teams,
            'email_price' => $curState->news()->email_filter_price,
            'encrypt_price' => $curState->news()->encryption_machine_price,
            'traffic_price' => $curState->news()->traffic_controller_price,
            'antivirus_price' => $curState->news()->antivirus_price,
            'input_price' => $curState->news()->input_validator_price,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);

        // replace null value to 0 of each item qty
        if ($request['email-qty'] == null) $request['email-qty'] = 0;
        if ($request['encrypt-qty'] == null) $request['encrypt-qty'] = 0;
        if ($request['traffic-qty'] == null) $request['traffic-qty'] = 0;
        if ($request['antivirus-qty'] == null) $request['antivirus-qty'] = 0;
        if ($request['input-qty'] == null) $request['input-qty'] = 0;

        // validate request
        $request->validate([
            'team-name' => 'required|string',
            'email-qty' => 'required|integer|min:0',
            'encrypt-qty' => 'required|integer|min:0',
            'traffic-qty' => 'required|integer|min:0',
            'antivirus-qty' => 'required|integer|min:0',
            'input-qty' => 'required|integer|min:0',
        ]);

        // check if the team exists
        try {
            $team = Team::where('nama', $request['team-name'])->firstOrFail();
            // return redirect()->route('admin.market')->with('success', 'Team ' . $request['team-name'] . ' found! Score=' . $team->semiStatistic->score);
        } catch (Exception $e) {
            return redirect()->route('admin.market')->with('error', 'Team ' . $request['team-name'] . ' not found!');
        }

        // get current semi state
        $curState = SemiState::first();

        // calculate total price
        $emailPrice = (int) ($request['email-qty'] * $curState->news()->email_filter_price);
        $encryptPrice = (int) ($request['encrypt-qty'] * $curState->news()->encryption_machine_price);
        $trafficPrice = (int) ($request['traffic-qty'] * $curState->news()->traffic_controller_price);
        $antivirusPrice = (int) ($request['antivirus-qty'] * $curState->news()->antivirus_price);
        $inputPrice = (int) ($request['input-qty'] * $curState->news()->input_validator_price);
        $totalPrice = $emailPrice + $encryptPrice + $trafficPrice + $antivirusPrice + $inputPrice;
        // dd($emailPrice . ", " . $encryptPrice . ", " . $trafficPrice . ", " . $antivirusPrice . ", " . $inputPrice . " = " . $totalPrice);

        // check if team score sufficient to buy
        $semiStat = $team->semiStatistic;
        if ($semiStat->score < $totalPrice) {
            return redirect()->route('admin.market')->with('error', 'Team ' . $request['team-name'] . " has less than " . $totalPrice . " points (current: " . $semiStat->score . ")");
        }

        // execute actual tx
        try {
            DB::transaction(function () use ($semiStat, $request, $totalPrice, $curState) {
                // add item qty and decrement score
                $semiStat->email_filter += $request['email-qty'];
                $semiStat->encryption_machine += $request['encrypt-qty'];
                $semiStat->traffic_controller += $request['traffic-qty'];
                $semiStat->antivirus += $request['antivirus-qty'];
                $semiStat->input_validator += $request['input-qty'];
                $semiStat->score -= $totalPrice;
                $semiStat->save();

                // decrement current news slot
                $curNews = $curState->news();
                $curNews->slot -= 1;
                $curNews->save();

                // check if current slot <= 0
                if ($curNews->slot <= 0) {
                    $curState->current_news_slug = $curNews->next_slug;
                    $curState->save();
                }
            });

            return redirect()->route('admin.market')->with('success', 'Team ' . $request['team-name'] . " transactions completed (total price: " . $totalPrice . ")");
        } catch (Exception $e) {
            return redirect()->route('admin.market')->with('error', "Database error! (" . $e->getMessage() . ")");
        }
    }
}
