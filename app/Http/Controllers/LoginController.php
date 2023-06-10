<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\QueryDataTable;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // dropdown sorting
                $gender = $request->input('gender');
                $kartu = $request->input('kartu');
                if ($gender !== null && $kartu !== null) {
                    $query = DB::table('users')->where('gender', $gender)->where('kartu', $kartu);
                } elseif ($gender !== null ) {
                    $query = DB::table('users')->where('gender', $gender);
                } elseif ($kartu !== null ) {
                    $query = DB::table('users')->where('kartu', $kartu);
                } else {
                    $query = DB::table('users');
                }
            // END dropdown sorting

            return DataTables::queryBuilder($query)
            ->addIndexColumn()
            ->addColumn('aksi', function($model) {
                $btn = '<a href="'. route('edit', ['id' => $model->id]) .'" type="button" target="_blank" class="btn btn-primary">
                Edit Data
                </a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
        }

        return view('login', [
            'title' => 'Login'
        ]);
    }

    // public function data()
    // {
    //     return DataTables::of(User::query())
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function($model) {
    //             $btn = '<a href="'. route('edit', ['id' => $model->id]) .'" type="button" target="_blank" class="btn btn-primary">
    //             Edit Data
    //             </a>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->toJson();
    // }

    // public function filter()
    // {
    //     $query = User::where();
    //     return DataTables::of($query)
    //         ->addIndexColumn()
    //         ->addColumn('aksi', function($model) {
    //             $btn = '<a href="'. route('edit', ['id' => $model->id]) .'" type="button" target="_blank" class="btn btn-primary">
    //             Edit Data
    //             </a>';
    //             return $btn;
    //         })
    //         ->rawColumns(['aksi'])
    //         ->toJson();
    // }

    public function edit($id)
    {
        $user = User::find($id);
        return @dd($user);
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
            $user = User::where('email', $request->input('email'))->first();

            if (!$user) {
                return response()->json([
                    'status' => 401,
                    'messages' => 'Email atau Password anda salah!'
                ]);
            } else {
                if(Hash::check($request->input('password'), $user->password)) {
                    return response()->json([
                        'status' => 200,
                        'messages' => 'Login berhasil, dalam 5 detik anda akan login!'
                    ]);
                } else {
                    return response()->json([
                        'status' => 401,
                        'messages' => 'Email atau Password anda salah!'
                    ]);
                }
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
