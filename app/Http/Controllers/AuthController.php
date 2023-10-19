<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //

    public function postlogin(Request $request)
    {

        $input = $request->all();

        $rules = [

            'email'     => 'required',
            'password'  => 'required',
        

        ];
        // error message untuk validasi
        $message = [
            'required' => ':attribute tidak boleh kosong!'
        ];
        // instansiasi validator
        $validator = Validator::make($request->all(), $rules, $message);

        // proses validasi
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        
        if (User::where('email', '=', $input['email'])->first() == true) {
     
            if (auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))) {
                
                return redirect('dashboard')->with('success', 'Berhasil Login');
            } else {
                return redirect()->back()
                    ->with('error', 'Password salah');
            }
        
    }else{
            return redirect()->back()
            ->with('error', 'Email tidak ada atau belum terdaftar');
        }
    }

    public function login()
    {
        if(auth()->check()){
            // switch (Auth::user()->role) {
            //     case 'superadmin':
            //         
            //         break;
            // }
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/');
      }
}
