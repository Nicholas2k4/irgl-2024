<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SemiState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LockController extends Controller
{
    public function index()
    {
        return view('admin.lock', [
            'title' => 'Lock',
        ]);
    }
    public function index2()
    {
        return view('admin.lock2', [
            'title' => 'Lock 2',
        ]);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction();

            $semiState = DB::table('semi_states')->lockForUpdate()->first();

            sleep(5);

            if($semiState->email_filter_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['email_filter_price' => $r['price']]);
            }
            else if($semiState->encryption_machine_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['encryption_machine_price' => $r['price']]);
            }
            else if($semiState->traffic_controller_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['traffic_controller_price' => $r['price']]);
            }
            else if($semiState->antivirus_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['antivirus_price' => $r['price']]);
            }
            else if($semiState->input_validator_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['input_validator_price' => $r['price']]);
            }
            else
            {
                return redirect()->back()->with('error', 'Already filled!');
            }

            DB::commit();
            return redirect()->back()->with('success', 'Changed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error accessing database!');
            throw $e;
        }
    }

    public function store2(Request $r)
    {
        try {
            DB::beginTransaction();

            sleep(4);

            $semiState = DB::table('semi_states')->lockForUpdate()->first();

            if($semiState->email_filter_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['email_filter_price' => $r['price']]);
            }
            else if($semiState->encryption_machine_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['encryption_machine_price' => $r['price']]);
            }
            else if($semiState->traffic_controller_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['traffic_controller_price' => $r['price']]);
            }
            else if($semiState->antivirus_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['antivirus_price' => $r['price']]);
            }
            else if($semiState->input_validator_price == 0)
            {
                SemiState::where('id', $semiState->id)->update(['input_validator_price' => $r['price']]);
            }
            else
            {
                return redirect()->back()->with('error', 'Already filled!');
            }

            DB::commit();
            return redirect()->back()->with('success', 'Changed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error accessing database!');
            throw $e;
        }
    }
}
