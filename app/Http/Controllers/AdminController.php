<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;
use App\Models\Team;
use App\Models\User;
use Google_Client;
use Google_Service_Oauth2;

class AdminController extends Controller
{
    public function main(){
        $data['username'] = session('name');
        $data['email'] = session('email');
        $data['nrp'] = session('nrp');
        $data['division_name'] = session('division_name');
        return view('admin.main', $data);
    }

    public function rekapTeam(){
        $teams = Team::with('user')->get();
        $users = User::with('team')->get();
        return view('admin.rekapTeam',compact('teams','users'));
    }
}
