<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeAccountCreated;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Profile;
use App\Models\LoginLog;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

    /**
     * Show the form to request a password reset link.
     */
    public function showForgotForm()
    {
        return view('auth.passwords.email');
    }

    /**
     * Send a password reset link to the given user.
     */
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        try {
            $status = Password::sendResetLink($request->only('email'));

            if ($status === Password::RESET_LINK_SENT) {
                return back()->with('success', __($status));
            }

            return back()->withErrors(['email' => __($status)]);
        } catch (\Throwable $ex) {
            // Mail transport failed (DNS/SMTP issue). Fall back to generating the token
            // and logging the reset link so local testing still works.
            Log::warning('Mail transport error while sending password reset: ' . $ex->getMessage());

            $user = \App\Models\User::where('email', $request->email)->first();
            if (! $user) {
                return back()->withErrors(['email' => 'Unable to send reset link.']);
            }

            // Create a token and persist it via the broker
            $token = Password::broker()->createToken($user);

            // Build reset URL
            $resetUrl = url(route('password.reset', ['token' => $token, 'email' => $user->email], false));

            // Log the URL for developer to copy/use
            Log::info('Password reset URL for ' . $user->email . ': ' . $resetUrl);

            // Also return a success message to the user (without exposing token)
            return back()->with('success', 'We have emailed your password reset link. (If email delivery failed, a reset link was logged for local testing.)');
        }
    }

    /**
     * Show the password reset form for the given token.
     */
    public function showResetForm($token)
    {
        return view('auth.passwords.reset', compact('token'));
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->setRememberToken(Str::random(60));
                $user->save();
                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', __('Your password has been reset. You can now login.'));
        }

        return back()->withErrors(['email' => __($status)]);
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

            $plainPassword = $request->password;

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'role' => 'retailer',
                'status' => 'pending',
                'password' => Hash::make($plainPassword),
            ]);

            Wallet::create(['user_id' => $user->id, 'balance' => 0]);
            Profile::create(['user_id' => $user->id, 'kyc_status' => 'pending']);

            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'register',
                'description' => 'New user registered',
                'ip_address' => $request->ip(),
            ]);

            app()->terminating(function () use ($user, $plainPassword) {
                try {
                    Mail::to($user->email)->send(new WelcomeAccountCreated($user, $plainPassword));
                } catch (\Throwable $mailException) {
                    Log::warning('Welcome mail could not be sent after registration for ' . $user->email . ': ' . $mailException->getMessage());
                }
            });

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
