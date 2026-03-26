<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Profile;
use App\Models\LoginLog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            LoginLog::create([
                'user_id' => auth()->id(),
                'ip_address' => $request->ip(),
                'status' => 'success',
                'user_agent' => $request->userAgent(),
            ]);

            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'login',
                'description' => 'User logged in successfully',
                'ip_address' => $request->ip(),
            ]);

            return match(auth()->user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'distributor' => redirect()->route('distributor.dashboard'),
                'retailer' => redirect()->route('retailer.dashboard'),
                default => redirect('/'),
            };
        }

        LoginLog::create([
            'ip_address' => $request->ip(),
            'status' => 'failed',
            'login_attempts' => 1,
            'user_agent' => $request->userAgent(),
        ]);

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'mobile' => 'required|string|size:10|unique:users',
                'password' => 'required|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role' => 'retailer',
                'status' => 'pending',
                'password' => Hash::make($request->password),
            ]);

            Wallet::create(['user_id' => $user->id, 'balance' => 0]);
            Profile::create(['user_id' => $user->id, 'kyc_status' => 'pending']);

            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'register',
                'description' => 'New user registered',
                'ip_address' => $request->ip(),
            ]);

            // Keep user on register page and show a success message (admin approval pending)
            return back()->with('success', 'Registration successful! Please wait for admin approval.');
        } catch (QueryException $ex) {
            // Likely database not available or not configured. Show friendly message.
            return back()->withInput()->with('error', 'Database error: please ensure the application database exists and is configured. See README for setup steps.');
        }
    }

    public function logout(Request $request)
    {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'logout',
            'description' => 'User logged out',
            'ip_address' => $request->ip(),
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
