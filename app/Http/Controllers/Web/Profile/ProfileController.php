<?php

namespace App\Http\Controllers\Web\Profile;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('pages.profile.index', [
            'user' => Auth::user(),
        ]);
    }
}
