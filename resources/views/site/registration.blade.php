@extends('layouts.site_form')

@section('title', 'Регистрация')

@section('content')
    <div class="container-contact100">

        <div class="wrap-contact100">
            <form class="contact100-form validate-form registration-form" method="POST" action="/user/create">
				<span class="contact100-form-title">
					Регистрация
				</span>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="text" name="name" placeholder="Имя">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="text" name="login" placeholder="Логин">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="text" name="email" placeholder="Почта">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="password" name="password" placeholder="Пароль">
                    <span class="focus-input100"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Поле должно быть заполнено">
                    <input class="input100" type="password" name="password_confirmation" placeholder="Повторите пароль">
                    <span class="focus-input100"></span>
                </div>

                {{ csrf_field() }}

                <div class="alert alert-success success-message" style="display: none; margin-top: 10px;">
                    <span id="name">User</span>, вы успешно зарегистрировались, авторизуйтесь!
                </div>

                <div class="container-contact100-form-btn">
                    <button class="contact100-form-btn registration-form">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Регистрация
						</span>
                    </button>
                </div>

                <div style="margin-top: 10px;text-align: center;">
                    <span>У вас есть аккаунт? <a href="/login">Авторизуйтесь</a></span>
                </div>    

                <div class="alert alert-danger error-message" style=" display: none; margin-top: 10px;">

                </div>
            </form>
        </div>
    </div>
@endsection
