<?php

namespace App\Http\Controllers;

use App\Models\Allow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // dd(bcrypt('111111'));
        if (Auth::check()) {

            if (Auth::user()->role == 1) {
                return redirect()->route('dashboard');
            } else {
                return back();
            }
        }
        if ($request->isMethod('POST')) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);
            if (Auth::attempt($credentials)) {
                if (Auth::user()->role == 1) {
                    try {
                        DB::beginTransaction();
                        $user = User::find(Auth::user()->id);
                        $user->last_login_at = Carbon::now();
                        $user->last_login_ip = $request->ip();
                        $user->save();
                        DB::commit();
                        // dd('yes');
                    } catch (\Exception $e) {
                        DB::rollBack();
                        info('saving last login info failed: ' . $e->getMessage());
                    }
                    $request->session()->regenerate();
                    // dd('beast');
                    return redirect('/admin/dashboard');
                }
            }

            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
        return view('admin.login');
    }

    public function register(Request $request)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        if ($request->isMethod('POST')) {
            $request->validate(
                [
                    'name' => 'required|string',
                    'email' => 'required|string|email|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                ],
                [
                    'name.required' => 'Enter your full name',
                    'email.required' => 'Enter your email',
                ]
            );

            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                // dd($user);
                $user->save();
                Auth::loginUsingId($user->id);
                return redirect()->route("apply")->withSuccess('Login details saved, please continue by filling the form');
            } catch (\Exception $e) {
                return back()->withErrors('An error occurred');
            }
        }
        return view('admin.register');
    }

    public function admin_create(Request $request)
    {
        // if (Auth::user() && Auth::user()->role == 1) {
        //     return redirect()->route('dashboard');
        // } else {
        //     $allow_reg = Allow::first();
        //     if ($allow_reg->allow_reg !== 'Yes') {
        //         return back();
        //     }
        // }

        if ($request->isMethod('POST')) {
            try {
                $allow_reg = Allow::first();
                if ($allow_reg->allow_reg !== 'Yes') {
                    return back()->withErrors('Error');
                }
            } catch (\Exception $e) {
                return back()->withErrors('An Error occurred');
            }
            $request->validate(
                [
                    'name' => 'required|string',
                    'email' => 'required|string|email|unique:users',
                    'password' => 'required|string|min:6|confirmed',
                ],
                [
                    'name.required' => 'Enter your full name',
                    'email.required' => 'Enter your email',
                ]
            );

            try {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->role = 1;
                $user->password = Hash::make($request->password);
                // dd($user);
                $user->save();
                return redirect()->route("login")->withSuccess('Successful');
            } catch (\Exception $e) {
                return back()->withErrors('An error occurred');
            }
        }

        return view('admin.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
