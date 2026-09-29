<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showLogin(Request $request): View
    {
        $this->storeSafeIntendedUrl($request);

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
            'remember' => ['nullable', 'boolean'],
        ]);

        if (!Auth::attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ], $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'The email or password is incorrect.'])
                ->withInput($request->only('email', 'remember'));
        }

        $request->session()->regenerate();

        return redirect()->intended(route('profile.show'));
    }

    public function showRegister(Request $request): View
    {
        $this->storeSafeIntendedUrl($request);

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->intended(route('profile.show'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    private function storeSafeIntendedUrl(Request $request): void
    {
        $redirect = (string) $request->query('redirect', '');

        if ($redirect === '' || str_contains($redirect, '\\')) {
            return;
        }

        $parsed = parse_url($redirect);
        $host = $parsed['host'] ?? null;
        $scheme = $parsed['scheme'] ?? null;
        $isRelativeInternalPath = str_starts_with($redirect, '/')
            && !str_starts_with($redirect, '//')
            && $host === null
            && $scheme === null;
        $isSameHostAbsoluteUrl = $host === $request->getHost()
            && ($scheme === null || in_array($scheme, ['http', 'https'], true))
            && ($scheme === null || $scheme === $request->getScheme());

        if ($isRelativeInternalPath || $isSameHostAbsoluteUrl) {
            $request->session()->put('url.intended', $redirect);
        }
    }
}
