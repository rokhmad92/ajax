<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('login', [
            'title' => 'Login'
        ]);
    }

    public function login(Request $request)
    {
        $validateData = validator::make($request->input(), [
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);

        if($validateData->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validateData->getMessageBag()
            ]);
        } else {
            if (Auth::attempt($validateData)) {
                return response()->json([
                    'status' => 200,
                    'messages' => 'Login berhasil, dalam 5 detik anda akan login!'
                ]);
            } else {
                return back()->with('danger', 'Email atau Password salah!');
            }
        }

        // if (Auth::attempt($validateData)) {
        //     return 'Berhasil Login!';
        // } else {
        //     return back();
        // }
    }

    public function registerView()
    {
        return view('register', [
            'title' => 'Register'
        ]);
    }

    public function store(Request $request)
    {
        $validateData = validator::make($request->input(), [
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6|max:20',
            'cpassword' => 'required|min:6|same:password'
        ], [
            'cpassword.same' => 'Confirmasi password tidak sama!',
        ]);

        if($validateData->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validateData->getMessageBag()
            ]);
        } else {
            $user = New User;
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return response()->json([
                'status' => 200,
                'messages' => 'Registrasi berhasil, dalam 5 detik anda akan di alihkan!'
            ]);
        }

        // $user = New User;
        // $user->email = $request->input('email');
        // $user->username = $request->input('username');
        // $user->password = bcrypt($request->input('password'));
        // $user->save();

        // return back();
    }

    public function forgotView()
    {
        return view('forgot', [
            'title' => 'Lupa sandi'
        ]);
    }
}
