<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StartSessionRequest;
use App\User;

class SessionController extends Controller
{
    /**
     * Начало сессии
     * @param StartSessionRequest $request
     */
    public function start(StartSessionRequest $request)
    {
        $user = User::findByLogin($request->input('login'));
        Auth()->login($user);
        return $user;
    }

    /**
     * Завершение сессии
     */
    public function logout()
    {
        Auth()->logout();
        return redirect('/');
    }
}
