<?php

namespace App\Http\Controllers\login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTracking;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


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
    $userTracking = UserTracking::where('user_id',$users->id)->first();

    $remember = $request->has('remember');
    $credentials = $request->only('email','password');
  if(Auth::attempt($credentials, $remember)){
      if($userTracking){
        $userTracking->status_conection='1';
        $userTracking->last_conection=now();
        $userTracking->save();
        }else{
          $userTracking = new UserTracking();
          $userTracking->user_id=$users->id;
          $userTracking->status=$users->status;
          $userTracking->status_conection='1';
          $userTracking->last_conection=now();
          $userTracking->save();
        }
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


  public function showForgotPasswordForm()
    {
        return view('content.login.forgot-password');
    }

    // Maneja la solicitud de código de recuperación
    public function sendValidationCode(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
          toast('Correo no existe en la base de datos, verifique','error')->autoClose(2000);
          return redirect()->route('password.request');
        }
        $code = random_int(100000, 999999);
        $user->reset_token = $code;
        $user->reset_token_expires_at = Carbon::now()->addMinutes(15); 
        $user->save();


        // Enviar el código por correo
        Mail::send('content.login.validation-code', ['code' => $code], function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Código de recuperación de contraseña');
        });

        return redirect()->route('password.verify')->with(['email' => $user->email]);
    }

    public function showVerifyCodeForm()
    {
        return view('content.login.verify-code');
    }

    public function verifyCode(Request $request)
{
    $user = User::where('email', $request->email)
                ->where('reset_token', $request->code)
                ->where('reset_token_expires_at', '>', Carbon::now())
                ->first();

    if (!$user) {
        session()->flash('error', 'El Código ingresado es incorrecto, reintente');
        return redirect()->route('password.verify')->with('email', $request->email);
    }
    return redirect()->route('password.reset', ['email' => $user->email]);
}


    public function showResetPasswordForm(Request $request)
    {
        return view('content.login.reset-password', ['email' => $request->email]);
    }

    public function resetPassword(Request $request)
{
    $request->validate([
      'email' => 'required|email|exists:users,email',
      'password' => 'required|min:8|confirmed', 
    ], [
      'email.required' => 'El correo electrónico es obligatorio.',
      'email.email' => 'Debe ingresar un correo electrónico válido.',
      'email.exists' => 'Este correo electrónico no está registrado.',
      'password.required' => 'La contraseña es obligatoria.',
      'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
      'password.confirmed' => 'Las contraseñas no coinciden.',
    ]);
    
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return back()->withErrors(['email' => 'El correo ingresado no es válido.'])->withInput();
    }

    $user->password = Hash::make($request->password);
    $user->reset_token = null;
    $user->reset_token_expires_at = null;
    $user->save();

    toast('Contraseña Restablecida','success')->autoClose(2000);
    return redirect()->route('login');
}

  }

