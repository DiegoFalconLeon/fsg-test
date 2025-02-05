<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Exports\UserExport;
use RealRashid\SweetAlert\Facades\Alert;


class UsersController extends Controller
{
    public function index(){
      $users = User::all();
      // confirmDelete('Borrar Usuario', '¿Está seguro que desea borrar al usuario?');
      return view('content.users.index',compact('users'));
    }

    public function create(){
      $users = User::all();
      $areas = Area::where('status','A')->get();
      return view('content.users.create', compact('users','areas'));
    }

    public function showUser($id){
    	$users = User::find($id);
      $areas = Area::where('status','A')->get();
    	return view('content.users.show', compact('users', 'areas'));
    }
    public function delete($id){
    	$users = User::find($id);
    	$users->delete();
      Alert::error('Usuario Eliminado', 'Se borró el usuario')->autoClose(1500);
    	return redirect()->route('users.list');
    }

    public function update(Request $request){
    	$id = $request->id;
      $users = User::find($id);
      $users->area_id = $request->areas;
    	$users->name = $request->name;
      $users->lastname = $request->lastname;
    	$users->email = $request->email;
      if($request->password != null){
        $users->password = Hash::make($request->password);
      }
      $file = $request->file('image');
      if ($file) {
        if ($request->image != 'default.png') {
          $filename = $users->name ." " . $users->lastname .".png";
          $users->image=$filename;
          $file->storeAs('user', $filename);
          $img = \Image::make($file->path());
          $imgurl = storage_path('app/user');
          $img->save("$imgurl/$filename");
        }
      }
      $users->role= $request->role;
      $users->status = $request->status;
    	$users->save();
      Alert::success('Usuario actualizado', 'Se actualizó al usuario correctamente')->autoClose(1500);
    	return redirect()->route('users.list');
    }
    public function newUser(Request $request){
      $users = new User();
      $users->area_id = $request->areas;
      $users->name = $request->name;
      $users->lastname = $request->lastname;
      $users->email = $request->email;
      $users->password = Hash::make($request->password);
      $users->status = $request->status;
      $users->role= $request->role;
      $file = $request->file('image');
      if ($file) {
        $filename = $users->name ." " . $users->lastname .".png";
        $users->image=$filename;
        $file->storeAs('user', $filename);
        $img = \Image::make($file->path());
        $imgurl = storage_path('app/user');
        $img->save("$imgurl/$filename");
      }
      $users->save();
      Alert::success('Usuario Creado', 'se creó el usuario correctamente')->autoClose(1500);
      return redirect()->route('users.list');
    }

    public function exportPDF(){
      $users = User::all();
      $company = Company::find(1);
      $pdf = \PDF::loadView('content.users.pdf ', compact('users','company'));
      return $pdf->download('Usuarios.pdf');
    }

    public function exportExcel(){
      $excel = new UserExport;
      return \Excel::download($excel, 'Usuarios.xlsx');
    }
}
