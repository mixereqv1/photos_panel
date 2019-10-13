<?php
    include_once('connect.php');

    $user = $_POST['photo_username'];
    $dir = basename($_FILES['photo_img']['name']);
    $name = $_POST['photo_name'];
    $title = $_POST['photo_name'];

    $target_dir = "img/";
    $target_file = $target_dir . $dir;
    move_uploaded_file($_FILES['photo_img']['tmp_name'], $target_file);
    // if(move_uploaded_file($_FILES['photo_img']['tmp_name'], $target_file)) {
    //     echo "The file has been uploaded correctly.";
    // } else {
    //     echo "Problem with uploading photo to server.";
    // }

    $query = "INSERT INTO photos VALUES(null,'$user','$dir','$name','$title')";
    mysqli_query($mysqli,$query);
    header('location:index.php?action=show_form');
?>