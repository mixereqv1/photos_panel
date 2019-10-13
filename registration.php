<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.min.css">
        <title>Photos - user panel - registration</title>
    </head>
    <body>

        <div class="container">
            <header class="header">
                <h1>User panel</h1>
                <nav class="nav">
                    <a class="nav__link" href="index.php">Home</a>
                    <!-- <a class="nav__link" href="#">Login</a> -->
                </nav>
            </header>
            <main class="main">
                <form class="login__form" action="registration.php" method="post">
                    <?php include_once('errors.php'); ?>
                    <div class="login__form__item">
                        <label for="username">Username:</label>
                        <input type="text" name="registration_username" id="username">
                    </div>
                    <div class="login__form__item">
                        <label for="password_1">Password:</label>
                        <input type="password" name="registration_password_1" id="password_1">
                    </div>
                    <div class="login__form__item">
                        <label for="password_2">Confirm password:</label>
                        <input type="password" name="registration_password_2" id="password_2">
                    </div>
                    <div class="login__form__item">
                        <input type="submit" name="registration_submit" value="REGISTER">
                    </div>
                    <span>Already have an account? <a class="login__form__link" href="login.php">Login</a></span>
                </form>
            </main>
            <footer class="footer">
                <span>Created by Mateusz Ral 19'</span>
            </footer>
        </div>
        <script src="inputs.js"></script>
    </body>
</html>