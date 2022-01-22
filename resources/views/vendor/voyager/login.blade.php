<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" dir="{{ __('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title>Admin - {{ Voyager::setting("admin.title") }}</title>
    <link rel="stylesheet" href="{{ voyager_asset('css/app.css') }}">
    @if (__('voyager::generic.is_rtl') == 'true')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="{{ voyager_asset('css/rtl.css') }}">
    @endif
    <style>
        body {


            background-color: {
                    {
                    Voyager: :setting("admin.bg_color", "#FFFFFF")
                }
            }

            ;
        }

        body.login .login-sidebar {
            border-top:5px solid {
                    {
                    config('voyager.primary_color', '#22A7F0')
                }
            }

            ;
        }

        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top: 0px !important;

                border-left:5px solid {
                        {
                        config('voyager.primary_color', '#22A7F0')
                    }
                }

                ;
            }
        }

        body.login .form-group-default.focused {
            border-color: {
                    {
                    config('voyager.primary_color', '#22A7F0')
                }
            }

            ;
        }

        .login-button,
        .bar:before,
        .bar:after {
            background: {
                    {
                    config('voyager.primary_color', '#22A7F0')
                }
            }

            ;
        }

        .container-login {
            position: relative;
            width: 100%;
            height: 100vh;
        }

        .login-section {
            width: 800px;
            display: block;
            margin: auto;
            max-width: 90%;
            background: #fff;
            box-shadow: 0px 0px 17px grey;
            height: 360px;
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
        }

        .login-button {
            background: #2581f3;
        }

        .login-form-container {
            margin-right: 15px;
            margin-top: 40px;
            color: #333;
            font-weight: bold;
        }

        .remember-me-text {
            padding: 0 5px;
        }

        .login-lock img {
            width: 300px;
            margin: auto;
            display: block;
        }



        .login-lock {
            margin-bottom: 0px !important;
            height: 360px;
            position: relative;
            background: #526069;
        }

        .login-lock img {
            width: 300px;
            margin: auto;
            display: block;
            vertical-align: middle;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            max-width: 90%;
        }

        .hidden-xs.mb-login-lock img {
            width: 100px;
            position: absolute;
            top: -52px;
        }

        .mb-login-lock {}

        .mb-login-lock img {
            width: 100%;
        }

        @media (max-width: 767px) {

            .login-form-container {
                margin-left: 15px;
            }
        }



        .mb-login-lock {
            width: 100px;
            margin: auto;
            margin-top: -85px;
            box-shadow: 0px -2px 3px #333;
            border-radius: 75%;
        }
    </style>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>

<body class="login">
    <div class="container-login ">
        <div class="login-section">
            <div class="row">

                <div class="hidden-xs col-sm-6 col-md-6 login-lock">
                    <img src="{{ asset('frontend/img/login_lock.svg') }}" />
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 login-form">

                    <div class="login-form-container">

                        <div class="hidden-lg hidden-md hidden-sm mb-login-lock">
                            <img src="{{ asset('frontend/img/login_lock.svg') }}" />
                        </div>


                        <p> {{ __('voyager::login.signin_below') }}</p>

                        <form action="{{ route('voyager.login') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group form-group-default" id="emailGroup">
                                <label>{{ __('voyager::generic.email') }}</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{ __('voyager::generic.email') }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group form-group-default" id="passwordGroup">
                                <label>{{ __('voyager::generic.password') }}</label>
                                <div class="controls">
                                    <input type="password" name="password" placeholder="{{ __('voyager::generic.password') }}" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group" id="rememberMeGroup">
                                <div class="controls">
                                    <input type="checkbox" name="remember" id="remember" value="1"><label for="remember" class="remember-me-text">{{ __('voyager::generic.remember_me') }}</label>
                                </div>
                            </div>


                            <button type="submit" class="btn btn-block login-button">
                                <span class="signingin hidden"><span class="voyager-refresh"></span> {{ __('voyager::login.loggingin') }}...</span>
                                <span class="signin">{{ __('voyager::generic.login') }}</span>
                            </button>
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                            @endif

                        </form>

                        <div style="clear:both"></div>

                        @if(!$errors->isEmpty())
                        <div class="alert alert-red">
                            <ul class="list-unstyled">
                                @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                    </div> <!-- .login-container -->

                </div> <!-- .login-sidebar -->
            </div> <!-- .row -->
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <script>
        var btn = document.querySelector('button[type="submit"]');
        var form = document.forms[0];
        var email = document.querySelector('[name="email"]');
        var password = document.querySelector('[name="password"]');
        btn.addEventListener('click', function(ev) {
            if (form.checkValidity()) {
                btn.querySelector('.signingin').className = 'signingin';
                btn.querySelector('.signin').className = 'signin hidden';
            } else {
                ev.preventDefault();
            }
        });
        email.focus();
        document.getElementById('emailGroup').classList.add("focused");

        // Focus events for email and password fields
        email.addEventListener('focusin', function(e) {
            document.getElementById('emailGroup').classList.add("focused");
        });
        email.addEventListener('focusout', function(e) {
            document.getElementById('emailGroup').classList.remove("focused");
        });

        password.addEventListener('focusin', function(e) {
            document.getElementById('passwordGroup').classList.add("focused");
        });
        password.addEventListener('focusout', function(e) {
            document.getElementById('passwordGroup').classList.remove("focused");
        });
    </script>
</body>

</html>