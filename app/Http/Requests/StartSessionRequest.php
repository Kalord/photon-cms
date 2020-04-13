<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class StartSessionRequest extends FormRequest
{
    /**
     * @return array
     */
    public function messages()
    {
        return [
            'user.required' => 'Неверный логин или пароль'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Подготовка к валидации
     */
    protected function prepareForValidation()
    {
        $user = User::findByLogin($this->get('login'));

        if($user && Hash::check($this->get('password'), $user->password))
        {
            $this->merge([
                'user' => $user
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user' => 'required'
        ];
    }
}
