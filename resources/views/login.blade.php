<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PhleboLab | Login</title>

        <link rel="icon" href="assets/images/favicon.ico.png" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            @import url(https://fonts.googleapis.com/css?family=Roboto:300);
            .container {
            position: relative;
            max-width: 300px;
            margin: 0 auto;
            }

            body {
            background-color: #25396d;
            font-family: "Roboto", sans-serif;
            }
            
            .login-page {
            width: 360px;
            padding: 8 0 0;
            margin: auto;
            }

            .login-page .form .details{
            margin-top: -35px;
            margin-bottom: 10px;
            }

            .form {
            position: relative;
            border-radius: 25px;
            background: #FFFFFF;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
            }

            .form input {
            font-family: "Roboto", sans-serif;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            }

            .form button {
            font-family: "Roboto", sans-serif;
            background-color: #35B0E2;
            width: 100%;
            border: 0;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            cursor: pointer;
            }

            .form .register {
            font-family: "Roboto", sans-serif;
            margin: 15px 0 0;
            color: gray;
            font-size: 12px;
            }

            .form .register a {
            font-family: "Roboto", sans-serif;
            color: #35B0E2;
            text-decoration: none;
            }

            .custom-error-alert {
                background-color: #ffcccc; 
                border: 1px solid #cc0000; 
                color: #cc0000; 
                padding: 10px;
                margin-top: 10px;
                margin-bottom: 10px;
                border-radius: 5px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <center>
            <br />
            <br />
            <img src="assets/images/phlebolab_logo.png" alt="logo" width="380" height="160">
            <br />
            <br />
            <div class="login-page">
                <div class="form">
                    <div class="details">
                        <div class="login-header">
                        <h3>STUDENT LOGIN</h3>
                        </div>
                    @if($errors->any())
                    <div class="alert alert-danger custom-error-alert">
                        
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger custom-error-alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    </div>
                    <form class="login-form" method="post" action="{{ route('login-user') }}" autocomplete="off">
                        @csrf
                        <input type="email" name="email" placeholder="Email" required autocomplete="off"/>
                        <input type="password" name="password" placeholder="Password" required autocomplete="off"/>
                        <button type="submit">Log In</button>
                        <p class="register">Not yet registered? <a href="{{ route('register') }}">Create an account now!</a></p>
                    </form>
                </div>
            </div>
            </center>
    </body>
</html>
