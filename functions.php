<?php
    function downloadImg($i,$dir,$title,$name,$author,$mysqli) {
        echo'
            <div class="photo">
                <img class="photo__img" src="img/'.$dir[$i].'" alt="'.$title[$i].'" title="'.$title[$i].'">
                <span class="photo__name">Name: '.$name[$i].'</span>
                <span class="photo__author">Author&#39;s username: '.$author[$i].'</span>
                <div class="photo__info">
                    '; if(userLiked($mysqli,$i+1)) { echo '
                        <i class="fa fa-thumbs-up like_btn" data-id="'; echo $i+1; echo'"></i>
                    '; } else { echo '
                        <i class="fa fa-thumbs-o-up like_btn" data-id="'; echo $i+1; echo '"></i>
                    '; } echo'
                    <span class="likes">'; echo getLikes($mysqli,$i+1); echo'</span>
                    '; if(userDisliked($mysqli,$i+1)) { echo'
                        <i class="fa fa-thumbs-down dislike_btn" data-id="'; echo $i+1; echo'"></i>
                    '; } else { echo'
                        <i class="fa fa-thumbs-o-down dislike_btn" data-id="'; echo $i+1; echo'"></i>
                    '; } echo'
                    <span class="dislikes">'; echo getDislikes($mysqli,$i+1); echo'</span>
                </div>
            </div>
        ';
    }

    function getAmountOfPhotos($mysqli) {
        $sql = "SELECT photo_id FROM photos";
        $result = $mysqli -> query($sql);
        return mysqli_num_rows($result);
    }

    function getLikes($mysqli,$id) {
        $sql = "SELECT count(*) AS sum_likes FROM rating_info WHERE photo_id = $id AND rating = 'like'";
        $rs = $mysqli -> query($sql);
        $result = $rs -> fetch_assoc();
        return $result['sum_likes'];
    }

    function getDislikes($mysqli,$id) {
        $sql = "SELECT count(*) AS sum_dislikes FROM rating_info WHERE photo_id = $id AND rating = 'dislike'";
        $rs = $mysqli -> query($sql);
        $result = $rs -> fetch_assoc();
        return $result['sum_dislikes'];
    }

    function getRating($mysqli,$id) {
        $ratings = [];
        $likes_query = "SELECT count(*) FROM rating_info WHERE photo_id = $id AND rating = 'like'";
        $dislikes_query = "SELECT count(*) FROM rating_info WHERE photo_id = $id AND rating = 'dislike'";

        $likes_rs = $mysqli -> query($likes_query);
        $dislikes_rs = $mysqli -> query($dislikes_query);

        $likes = $likes_rs -> fetch_assoc();
        $dislikes = $dislikes_rs -> fetch_assoc();

        $ratings = [
            'likes' => $likes[0],
            'dislikes' => $dislikes[0]
        ];

        $ratingJSON = json_encode($ratings);
        return $ratingJSON;
    }

    function userLiked($mysqli,$photo_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM rating_info WHERE user_id = $user_id 
                AND photo_id = $photo_id AND rating='like'";
        $result = $mysqli -> query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }else{
            return false;
        }
    }

    function userDisliked($mysqli,$photo_id) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT * FROM rating_info WHERE user_id = $user_id 
                AND photo_id = $photo_id AND rating = 'dislike'";
        $result = $mysqli -> query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        }else{
            return false;
        }
    }
?>