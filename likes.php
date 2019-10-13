<?php
    session_start();

    include_once('connect.php');
    include_once('functions.php');

    if(isset($_POST['action'])) {
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
            $action = $_POST['action'];
            $photo_id = $_POST['photo_id'];
            $user_id = $_SESSION['user_id'];
            if($action == 'like') {
                $sql = "INSERT INTO rating_info VALUES(null,$user_id, $photo_id, 'like')";
            } else if($action == 'dislike') {
                $sql = "INSERT INTO rating_info VALUES(null,$user_id, $photo_id, 'dislike')";
            } else if($action == 'unlike') {
                $sql = "DELETE FROM rating_info WHERE user_id = $user_id AND photo_id = $photo_id";
            } else {
                $sql = "DELETE FROM rating_info WHERE user_id = $user_id AND photo_id = $photo_id";
            }
            $mysqli -> query($sql);
            echo getRating($mysqli,$photo_id);
        } else {
            $res = 'Please login if you want to rate the photo.';
            echo json_encode($res);
        }
    }
    // $action = $_POST['action'];
    // $photo_id = $_POST['photo_id'];
    // echo $action;
    // echo $photo_id;
?>