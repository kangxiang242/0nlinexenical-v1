<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Filament::auth()->check()) {
            return redirect(Filament::getCurrentPanel()->getPath());
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Filament::auth()->attempt([
            'name' => $credentials['login'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {

            // Session has been migrated by SessionGuard::updateSession()
            // New session ID handled by the 302 redirect naturally
            Session::save();

            return redirect()->intended(Filament::getCurrentPanel()->getPath());
        }

        return back()->withErrors([
            'login' => '账号或密码错误',
        ]);
    }

    public function logout(Request $request)
    {
        Filament::auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(Filament::getCurrentPanel()->getPath() . '/login');
    }
}
