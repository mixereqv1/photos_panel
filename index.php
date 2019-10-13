<?php
    session_start();

    include_once('connect.php');
    include_once('functions.php');

    if(isset($_GET['action']) && $_GET['action'] == 'logout') {
        $_SESSION['logged_in'] = false;
        unset($_SESSION['username']);
        session_destroy();
    }

    $author = array();
    $dir = array();
    $name = array();
    $title = array();
    $query = "SELECT * FROM photos";
    if($result = $mysqli -> query($query)) {
        while($row = $result -> fetch_assoc()) {
            array_push($author,$row['photo_username']);
            array_push($dir,$row['photo_dir']);
            array_push($name,$row['photo_name']);
            array_push($title,$row['photo_title']);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <title>Photos - user panel</title>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    </head>
    <body>

        <div class="container">
            <header class="header">
                <h1>User panel</h1>
                <nav class="nav">
                    <?php if(!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) { ?>
                        <a class="nav__link" href="login.php">Login</a>
                    <?php } ?>
                </nav>
            </header>
            <main class="main">
                <?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
                    <div class="content">

                        <span class="welcome">You are logged in as: <span class="username"><?php echo $_SESSION['username']; ?></span></span>
                        <a class="logout__link" href="index.php?action=show_form">Add photo</a>
                        <a class="logout__link" href="index.php?action=logout">Logout</a>

                        
                    </div>
                <?php } ?>
                <?php if(isset($_GET['action']) && $_GET['action'] == 'show_form') { unset($_GET['action'])?>
                    <div class="add__photo">
                        <h2 class="add__photo__title">Add new photo</h2>
                        <form class="add__photo__form" action="add_photo.php" method="post" enctype="multipart/form-data">
                            <a class="close" href="index.php">X</a>
                            <input type="hidden" name="photo_username" value="<?php echo $_SESSION['username']; ?>">
                            <div class="item">
                                <input required type="file" name="photo_img" accept="image/*">
                            </div>
                            <div class="item">
                                <label for="photo_name">Photo's name...</label>
                                <input required id="photo_name" type="text" name="photo_name">
                            </div>
                            <div class="item">
                                <label for="photo_title">Photo's short description...</label>
                                <input required id="photo_title" type="text" name="photo_title">
                            </div>
                            <div class="item">
                                <input required type="submit" value="Add photo">
                            </div>
                        </form>
                    </div>
                <?php } ?>
                <div class="photos">
                    <?php 
                        for($i = 0; $i < getAmountOfPhotos($mysqli); $i++) { 
                            downloadImg($i,$dir,$title,$name,$author,$mysqli);
                        }
                    ?>
                </div>
            </main>
            <footer class="footer">
                <span>Created by Mateusz Ral 19'</span>
            </footer>
        </div>
        <script src="inputs.js"></script>
        <script src="likes_dislikes.js"></script>
    </body>
</html>