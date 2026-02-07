<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function create()
    {
        return view('pages.auth.login');
    }

    public function store(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt($data)) {
            return redirect()->intended();
        }

        return back()->withErrors([
            'login' => 'Неверные учетные данные'
        ]);

    }

    public function destroy()
    {
        Auth::logout();

        return redirect()->route('index');

    }
}
