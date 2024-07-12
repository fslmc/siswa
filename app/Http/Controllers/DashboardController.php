<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('superadministrator')){
            return view('superadministrator.dashboard');
        }else{
            return view('user.dashboard');
        }
    }
}
