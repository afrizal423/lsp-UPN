<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrasi</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <!-- <link href="assets/css/shop-homepage.css" rel="stylesheet"> -->

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
            crossorigin="anonymous"/>
        <style>
            body {
                color: #fff;
                background: #63738a;
                font-family: 'Roboto', sans-serif;
            }
            .form-control {
                height: 40px;
                box-shadow: none;
                color: #969fa4;
            }
            .form-control:focus {
                border-color: #5cb85c;
            }
            .btn,
            .form-control {
                border-radius: 3px;
            }
            .signup-form {
                width: 400px;
                margin: 0 auto;
                padding: 30px 0;
            }
            .signup-form h2 {
                color: #636363;
                margin: 0 0 15px;
                position: relative;
                text-align: center;
            }
            .signup-form h2:after,
            .signup-form h2:before {
                content: "";
                height: 2px;
                width: 30%;
                background: #d4d4d4;
                position: absolute;
                top: 50%;
                z-index: 2;
            }
            .signup-form h2:before {
                left: 0;
            }
            .signup-form h2:after {
                right: 0;
            }
            .signup-form .hint-text {
                color: #999;
                margin-bottom: 30px;
                text-align: center;
            }
            .signup-form form {
                color: #999;
                border-radius: 3px;
                margin-bottom: 15px;
                background: #f2f3f7;
                box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
                padding: 30px;
            }
            .signup-form .form-group {
                margin-bottom: 20px;
            }
            .signup-form input[type="checkbox"] {
                margin-top: 3px;
            }
            .signup-form .btn {
                font-size: 16px;
                font-weight: bold;
                min-width: 140px;
                outline: none !important;
            }
            .signup-form .row div:first-child {
                padding-right: 10px;
            }
            .signup-form .row div:last-child {
                padding-left: 10px;
            }
            .signup-form a {
                color: #fff;
                text-decoration: underline;
            }
            .signup-form a:hover {
                text-decoration: none;
            }
            .signup-form form a {
                color: #5cb85c;
                text-decoration: none;
            }
            .signup-form form a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <?php
        require_once('page/navbar.php');
        ?>
        <div class="signup-form">
            <form action="/examples/actions/confirmation.php" method="post">
                <h2>Registrasi</h2>
                <p class="hint-text">Form Registrasi Akun Baru.</p>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        name="username"
                        placeholder="Username"
                        required="required">
                </div>
                <div class="form-group">
                    <input
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="Password"
                        required="required">
                </div>

                
                <div class="form-group">
                    <input
                        type="password"
                        class="form-control"
                        name="confirm_password"
                        placeholder="Confirm Password"
                        required="required">
                </div>
                <div class="form-group">
                    <input
                        type="email"
                        class="form-control"
                        name="email"
                        placeholder="Email"
                        required="required">
                </div>
                <div class="form-group">
                <small>Tanggal Lahir</small>
                    <input
                        type="date"
                        class="form-control"
                        name="ttl"
                        placeholder="Tanggal Lahir"
                        required="required">
                    
                </div>
                <div class="form-group">
                    <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                        placeholder="Alamat"></textarea>
                </div>
                <div class="form-group">
                    <input
                        type="tel"
                        class="form-control"
                        name="no_hp"
                        placeholder="No HP"
                        required="required">
                </div>
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        name="paypal_id"
                        placeholder="Paypal ID"
                        required="required">
                </div>
                
                <div class="form-group">
                    <label class="checkbox-inline"><input type="checkbox" required="required">
                        I accept the
                        <a href="#">Terms of Use</a>
                        &amp;
                        <a href="#">Privacy Policy</a>
                    </label>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
                </div>
            </form>
            <div class="text-center">Sudah punya akun?
                <a href="login">Sign in</a>
            </div>
        </div>
        <?php
        require_once('page/script.php');
        ?>
    </body>
</html>