<?php

namespace App\Http\Controllers\sessions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index(){
      return view('content.sessions.index');
    }
}
