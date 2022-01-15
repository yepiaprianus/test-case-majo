<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        if (Session::get('login')) {
            return redirect('beranda');
        }
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('login')->with('alert', $validator->errors()->all());
        }

        $username = $request->username;
        $password = $request->password;
        $token = bcrypt($request->username . Carbon::now());

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            $data = DB::table('users as u')
                ->join('master_role as ms', 'ms.role_id', 'u.role')
                ->select('u.role', 'u.password', 'u.id', 'u.photo', 'u.name', 'u.email', 'ms.role_name', 'u.last_login')
                ->where('username', $username)
                ->where('u.status', 1)
                ->first();
            DB::table('users')->where('id', '=', $data->id)->update(['api_token' => $token, 'active_login' => 1]);
            Session::put('id', $data->id);
            Session::put('role', $data->role);
            Session::put('role_name', $data->role_name);
            Session::put('name', $data->name);
            Session::put('email', $data->email);
            Session::put('foto', $data->photo);
            Session::put('login', true);
            return redirect('/beranda');
        }
        return redirect('login')->with('alert', 'Password atau Username Tidak Ada, Salah!');
    }

    public function logout()
    {
        $last_login = Carbon::now();
        $set = DB::table('users')
            ->where('id', Session::get('id'))
            ->update(['active_login' => 0, 'last_login' => $last_login]);
        if ($set) {
            Session::flush();
            Auth::logout();
            return redirect('/');
        } else {
            return redirect('beranda');
        }
    }
}
