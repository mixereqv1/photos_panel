<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.min.css">
        <title>Photos - user panel - login</title>
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
                <form class="login__form" action="login.php" method="post">
                    <?php include_once('errors.php'); ?>
                    <div class="login__form__item">
                        <label for="username">Username:</label>
                        <input type="text" name="login_username" id="username">
                    </div>
                    <div class="login__form__item">
                        <label for="password">Password:</label>
                        <input type="password" name="login_password" id="password">
                    </div>
                    <div class="login__form__item">
                        <input type="submit" name="login_submit" value="LOGIN">
                    </div>
                    <span>Not registered? <a class="login__form__link" href="registration.php">Create an account</a></span>
                </form>
            </main>
            <footer class="footer">
                <span>Created by Mateusz Ral 19'</span>
            </footer>
        </div>
        <script src="inputs.js"></script>
    </body>
</html>