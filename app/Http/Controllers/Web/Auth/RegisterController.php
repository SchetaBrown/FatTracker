<?php

namespace App\Http\Controllers\Web\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function create()
    {
        return view('pages.auth.register');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        User::create($data);
        return redirect()->route('index');
    }
}
