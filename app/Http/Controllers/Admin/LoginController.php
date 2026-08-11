<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected function dashboardUrl()
    {
        $panel = Filament::getCurrentPanel();
        // 优先用 dashboard 路由生成 URL
        $routeName = $panel->getId() . '.pages.dashboard';
        if (Route::has('filament.' . $routeName)) {
            return route('filament.' . $routeName);
        }
        return $panel->getUrl();
    }

    public function showLoginForm()
    {
        if (Filament::auth()->check()) {
            return redirect($this->dashboardUrl());
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

            Session::save();

            return redirect()->intended($this->dashboardUrl());
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

        return redirect($this->dashboardUrl() . '/login');
    }
}
