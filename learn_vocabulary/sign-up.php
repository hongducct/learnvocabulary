<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn Vocabulary</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="main.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <input type="radio" id="item-1" name="item" class="sign-in">
            <label for="item-1" class="item">Sign In</label>
            <input type="radio" id="item-2" name="item" class="sign-up" checked>
            <label for="item-2" class="item">Sign Up</label>
            <div class="login-form">
                <div id="sign-in-form">
                    <form action="./login/login.php" method="post" class="sign-in-htm">
                        <div class="group">
                            <input type="text" name="username" placeholder="Username" id="user" class="input">
                        </div>
                        <div class="group">
                            <input type="password" name="password" placeholder="Password" id="pass" class="input" data-type="password">
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign In">
                        </div>
                        <div class="hr"></div>
                        <div class="footer">
                            <a href="#forgot">Forgot Password?</a>
                        </div>
                    </form>
                </div>
                <div id="sign-up-form">
                    <form action="./login/signup.php" method="post" class="sign-up-htm" novalidate>
                        <?php if (isset($_GET['error'])) { ?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php } ?>
                        <div class="group">
                            <input type="text" name="username" placeholder="Username" id="user" class="input" autocomplete="off" required>
                        </div>
                        <div class="group">
                            <input type="text" name="email" placeholder="Email address" id="pass" class="input" autocomplete="off" required>
                        </div>
                        <div class="group">
                            <input type="password" name="password" placeholder="Password" id="pass" class="input" data-type="password" autocomplete="off" required>
                        </div>
                        <div class="group">
                            <input type="password" name="password_confirmation" placeholder="Repeat password" id="pass" class="input" data-type="password" autocomplete="off" required>
                        </div>
                        <div class="group">
                            <input type="submit" class="button" value="Sign Up">
                        </div>
                        <div class="hr"></div>
                        <div class="footer">
                            <a href="#item-1"><label for="item-1">Already have an account?</label></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


