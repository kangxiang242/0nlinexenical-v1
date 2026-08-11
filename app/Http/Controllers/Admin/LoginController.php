<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    protected function dashboardUrl()
    {
        $panel = Filament::getCurrentPanel();
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

        // 标准方式登录：查询用户 + 验证密码 + 写入 session
        $user = User::where('name', $credentials['login'])->first();
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Filament::auth()->login($user, $request->boolean('remember'));
            $request->session()->regenerate();

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
