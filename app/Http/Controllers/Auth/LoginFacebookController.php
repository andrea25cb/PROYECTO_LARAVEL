<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginFacebookController extends Controller
{
    public function redirect()
{
    return Socialite::driver('facebook')->redirect();
}
}
