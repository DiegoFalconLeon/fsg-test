<?php

namespace App\Http\Controllers\sessions;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserTracking;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index(){
        $users = User::with('tracking')->get();
      return view('content.sessions.index',compact('users'));
    }
}
