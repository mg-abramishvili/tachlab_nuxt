<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        if(!auth()->attempt($request->only('email', 'password'))) {
            throw new AuthenticationException();
        }
    }
}
