<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/login.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div class="container"> 
        <div class="wrap-login">
            <form action="/projeto_condominio/modal/login.php" method="GET">
                <h3 class="login-title">LOGIN</h3>

                <?php if (isset($_GET['error'])) { ?>
                    <p class="login-error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <div class="wrap-input" data-validate="Username is required">
                    <input class="input" type="text" name="username" placeholder="Username">
                </div>
                <div class="wrap-input" data-validate="Password is required">
                    <input class="input" type="password" name="pass" placeholder="Password">
                </div>
                <div class="login-btn">
                    <button type="submit" class="login-form-btn">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script>
    function entrar(){
        window.location = '/projeto_condominio/pages';
    }
</script>