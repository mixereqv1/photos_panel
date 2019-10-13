<?php
    session_start();
    include_once('connect.php');

    $errors = array();


    //REGISTRATION
    if(isset($_POST['registration_submit'])) {
        $username = $_POST['registration_username'];
        $password_1 = $_POST['registration_password_1'];
        $password_2 = $_POST['registration_password_2'];
    
        if(empty($username)) {
            array_push($errors, 'Username is required!');
        } 
        if(empty($password_1)) {
            array_push($errors, 'Password is required!');
        }
        if($password_1 != $password_2) {
            array_push($errors, 'Passwords must be identical!');
        }
    
    
        $check_user = "SELECT username FROM users WHERE username = '$username'";
        $result = $mysqli -> query($check_user);
        $user = $result -> fetch_assoc();
        if($user['username'] === $username) {
            array_push($errors, 'Username exists, try login.');
        }

        if(count($errors) == 0) {
            $password = md5($password_1);
            $query = "INSERT INTO users VALUES(null,'$username','$password')";
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
            $_SESSION['success'] = 'You are logged in';
            mysqli_query($mysqli,$query);
            header('location:index.php');
        }
    }


    //LOGIN
    if(isset($_POST['login_submit'])) {
        $username = $_POST['login_username'];
        $password = $_POST['login_password'];

        if(empty($username)) {
            array_push($errors,'Username is required!');
        }
        if(empty($password)) {
            array_push($errors,'Password is required!');
        }

        if(count($errors) == 0) {
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result= $mysqli -> query($query);
            $row = $result -> fetch_assoc();
            if($row['username'] === $username) {
                // $query_password = "SELECT password FROM users WHERE password = '$password'";
                // $result_password = mysqli_query($mysqli, $query_password);
                $password = md5($password);
                if($row['password'] === $password) {
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $username;
                    $_SESSION['logged_in'] = true;
                    $_SESSION['success'] = 'You are logged in';
                    header('location:index.php');
                } else {
                    array_push($errors, 'An account with this username / password does not exist');
                }
            } else {
                array_push($errors, 'An account with this username / password does not exist');
            }
        }
    }
?>