<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PhleboLab | Register</title>

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
            
            .register-page {
            width: 360px;
            padding: 8 0 0;
            margin: auto;
            }

            .register-page .form .details{
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

            .checkbox-container {
                margin-bottom: 15px;
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

            .custom-success-alert {
                background-color: #d4edda;
                border: 1px solid #28a745;
                color: #28a745; 
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
        </center>
        <div class="register-page">
            <div class="form">
                <div class="details">
                    <div class="register-header">
                        <h3>STUDENT REGISTRATION</h3>
                    </div>
                    @if($errors->any())
                    <div class="alert alert-danger custom-error-alert">
                        
                            @foreach ($errors->all() as $error)
                                {{ $error }} <br>
                            @endforeach
                        
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success custom-success-alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger custom-error-alert">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
                <form class="register-form" method="post" action="{{ route('register') }}" onsubmit="return validatePassword()">
                @csrf
                    <input type="text" name="first_name" placeholder="First Name" required autocomplete="off"/>
                    <input type="text" name="last_name" placeholder="Last Name" required autocomplete="off"/>
                    <input type="email" name="email" placeholder="Email" required autocomplete="off"/>
                    <input type="password" name="password" id="inputPassword" placeholder="Password" required autocomplete="off"/>
                    <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password" required autocomplete="off"/>
                    
                    <div class="checkbox-container">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">I agree to the <a href="{{ route('terms-and-conditions') }}" target="_blank">Terms and Conditions</a></label>
                    </div>
                    
                    <button type="submit">Register</button>
                    <p class="register">Already registered? <a href="{{ route('login') }}">Login Now!</a></p> 
                </form>
            </div>
        </div>
    </body>
</html>
