<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTracking;
use App\Models\User;
use App\Models\Company;


class LoginController extends Controller
{
  public function index()
  {
    $company =  Company::find(1);
    session(['logoCompany' => $company->image]);
    return view('content.login.index');
  }

  public function authenticate(Request $request){
    $email = $request->email;
    $users = User::where('email',$email)->first();
    $credentials = $request->only('email','password');
    if(Auth::attempt($credentials)){
        $userTracking = new UserTracking();
        $userTracking->user_id=$users->id;
        $userTracking->status=$users->status;
        $userTracking->status_conection='1';
        $userTracking->last_conection=now();
        $userTracking->save();
        return redirect()->route('dashboard-analytics');
    }else{

        toast('Datos incorrectos, reintente','error')->autoClose(2000);
        return redirect()->route('login');
    }
  }

  public function logout(){
    $userTracking = UserTracking::where('user_id',Auth::user()->id)->first();
    $userTracking->status_conection='0';
    $userTracking->last_conection=now();
    $userTracking->save();
    Auth::logout();
        return redirect()->route('login');
  }
}

