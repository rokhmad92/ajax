<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
        $validateData = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        if (Auth::attempt($validateData)) {
            return 'Berhasil Login!';
        } else {
            return back();
        }
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
                'messages' => 'Register Berhasil!'
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
