@extends('layouts.site_form')

@section('title', 'Вход в систему')

@section('content')
    <div class="container-contact100">

        <div class="wrap-contact100">
            <form class="contact100-form validate-form login-form" method="POST" action="/session/start">
				<span class="contact100-form-title">
					Вход в систему
				</span>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="text" name="login" placeholder="Логин">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="password" name="password" placeholder="Пароль">
                    <span class="focus-input100"></span>
                </div>

                {{ csrf_field() }}

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn auth-form">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Вход
						</span>
                    </button>
                </div>

                <div class="alert alert-danger error-message" style="margin-top: 10px; display: none;">

                </div>
            </form>
        </div>
    </div>
@endsection
