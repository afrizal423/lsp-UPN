<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrasi</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/css/register.css" rel="stylesheet">

        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
            integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
            crossorigin="anonymous"/>
        
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