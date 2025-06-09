<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            Alert::toast('Login failed! Invalid email or password.', 'error');
            return back();
        }

        Auth::login($user);

        Alert::toast('Login successful!', 'success');

        return redirect()->route('products.index');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Alert::toast('Registration successful! Please log in.', 'success');

            return redirect()->route('login');
        } catch (\Throwable $th) {
            Alert::toast('Registration failed! Please try again.', 'error');

            return back();
        }
    }


    public function logout(Request $request)
    {
        try {
            Auth::logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Alert::toast('Logout successful!', 'success');

            return redirect()->route('login');
        } catch (\Throwable $th) {
            Alert::toast('Logout failed! Please try again.', 'error');

            return back();
        }
    }
}
