<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;
use App\User;

class UserController extends Controller
{
    /**
     * Создание пользователя
     */
    public function create(CreateUserRequest $request)
    {
        return User::createUser($request->input());
    }
}
