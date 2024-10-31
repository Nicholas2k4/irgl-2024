<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\SemiState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Team;

class NewsController extends Controller
{
    public function index()
    {
        $curNews = SemiState::first()->news();
        return view('admin.news', [
            'current_news' => $curNews,
            'title' => 'News',
        ]);
    }

    public function skipNews()
    {
        try {
            DB::transaction(function () {
                $curState = SemiState::first();
                $curNews = SemiState::first()->news();
                $curState->current_news_slug = $curNews->next_slug;
                $curState->save();

                $nextNews = SemiState::first()->news();

                if ($curNews->attack_type != null) {
                    $teams = Team::all();
                    foreach ($teams as $team) {
                        $teamSemiStats = $team->semiStatistic;

                        // phising attack
                        if($curNews->attack_type == 'phising'){
                            if($teamSemiStats->email_filter > 0){
                                $teamSemiStats->email_filter--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->email_filter_price;
                                $teamSemiStats->save();
                            }
                        }

                        // brute force attack
                        if($curNews->attack_type == 'brute-force'){
                            if($teamSemiStats->encryption_machine > 0){
                                $teamSemiStats->encryption_machine--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->encryption_machine_price;
                                $teamSemiStats->save();
                            }
                        }

                        // ddos attack
                        if($curNews->attack_type == 'ddos'){
                            if($teamSemiStats->traffic_controller > 0){
                                $teamSemiStats->traffic_controller--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->traffic_controller_price;
                                $teamSemiStats->save();
                            }
                        }

                        // malware attack
                        if($curNews->attack_type == 'malware'){
                            if($teamSemiStats->antivirus > 0){
                                $teamSemiStats->antivirus--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->antivirus_price;
                                $teamSemiStats->save();
                            }
                        }

                        // sql injection attack
                        if($curNews->attack_type == 'sql-injection'){
                            if($teamSemiStats->input_validator > 0){
                                $teamSemiStats->input_validator--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->input_validator_price;
                                $teamSemiStats->save();
                            }
                        }

                        // dystopia attack
                        if($curNews->attack_type == 'dystopia'){
                            if($teamSemiStats->email_filter > 0){
                                $teamSemiStats->email_filter--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->email_filter_price;
                                $teamSemiStats->save();
                            }

                            if($teamSemiStats->traffic_controller > 0){
                                $teamSemiStats->traffic_controller--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->traffic_controller_price;
                                $teamSemiStats->save();
                            }

                            if($teamSemiStats->antivirus > 0){
                                $teamSemiStats->antivirus--;
                                $teamSemiStats->save();
                            }
                            else{
                                $teamSemiStats->score-=$nextNews->antivirus_price;
                                $teamSemiStats->save();
                            }
                        }

                        // convert back
                        if($curNews->attack_type == 'convert'){
                            if($teamSemiStats->email_filter > 0){
                                $teamSemiStats->score += $teamSemiStats->email_filter * $nextNews->email_filter_price;
                                $teamSemiStats->email_filter = 0;
                                $teamSemiStats->save();
                            }

                            if($teamSemiStats->encryption_machine > 0){
                                $teamSemiStats->score += $teamSemiStats->encryption_machine * $nextNews->encryption_machine_price;
                                $teamSemiStats->encryption_machine = 0;
                                $teamSemiStats->save();
                            }

                            if($teamSemiStats->traffic_controller > 0){
                                $teamSemiStats->score += $teamSemiStats->traffic_controller * $nextNews->traffic_controller_price;
                                $teamSemiStats->traffic_controller = 0;
                                $teamSemiStats->save();
                            }

                            if($teamSemiStats->antivirus > 0){
                                $teamSemiStats->score += $teamSemiStats->antivirus * $nextNews->antivirus_price;
                                $teamSemiStats->antivirus = 0;
                                $teamSemiStats->save();
                            }

                            if($teamSemiStats->input_validator > 0){
                                $teamSemiStats->score += $teamSemiStats->input_validator * $nextNews->input_validator_price;
                                $teamSemiStats->input_validator = 0;
                                $teamSemiStats->save();
                            }
                        }
                    }
                }

                Log::channel('daily')->info(Session::get('name') . ' updated the news from ' . $curNews->slug . ' to ' . $curNews->next_slug);
            });
            return redirect()->route('admin.news')->with('success', 'News skipped!');
        } catch (Exception $e) {
            return redirect()->route('admin.news')->with('error', 'Failed to skip news!');
        }
    }

    public function semifinalHome(){
        $data =[
            'title' => 'Home',
        ];
        return view('semifinal.home', $data);
    }

    public function semifinalNews(){
        $curNews = SemiState::first()->news();
        $data =[
            'title' => 'News',
            'news_content' => $curNews->content,
        ];
        return view('semifinal.news', $data);
    }

    public function semifinalInventory(){
        $curNews = SemiState::first()->news();
        $semiStats = Team::where('id', session('team_id'))->firstOrFail()->semiStatistic;
        $data =[
            'title' => 'Inventory',
            'email_price' => $curNews->email_filter_price,
            'encrypt_price' => $curNews->encryption_machine_price,
            'traffic_price' => $curNews->traffic_controller_price,
            'antivirus_price' => $curNews->antivirus_price,
            'input_price' => $curNews->input_validator_price,
            'email_qty' => $semiStats->email_filter,
            'encrypt_qty' => $semiStats->encryption_machine,
            'traffic_qty' => $semiStats->traffic_controller,
            'antivirus_qty' => $semiStats->antivirus,
            'input_qty' => $semiStats->input_validator,
            'score' => $semiStats->score,
        ];
        return view('semifinal.inventory', $data);
    }
}
