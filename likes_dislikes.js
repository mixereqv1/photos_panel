$(document).ready(a => {

    // if the user clicks on the like button ...
    $('.like_btn').on('click', function(){
        $photo_id = $(this).data('id');
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
            action = 'like';
        } else if($clicked_btn.hasClass('fa-thumbs-up')){
            action = 'unlike';
        }
        $.ajax({
            url: 'likes.php',
            type: 'post',
            data: {
                'action': action,
                'photo_id': $photo_id
            },
            success: function(data){
                if(typeof res != 'object') {
                    let alert_div = document.createElement('div');
                    let close_alert_div = document.createElement('div');
                    alert_div.className = 'alert';
                    close_alert_div.className = 'alert__close';
                    alert_div.innerText = 'Please login if you want to rate the photos.';
                    close_alert_div.innerText = 'X';

                    close_alert_div.addEventListener('click', event => {
                        event.target.parentElement.remove();
                    })

                    alert_div.appendChild(close_alert_div);
                    document.querySelector('body').appendChild(alert_div);
                } else {
                    res = JSON.parse(data);
                    if (action == "like") {
                        $clicked_btn.removeClass('fa-thumbs-o-up');
                        $clicked_btn.addClass('fa-thumbs-up');
                    } else if(action == "unlike") {
                        $clicked_btn.removeClass('fa-thumbs-up');
                        $clicked_btn.addClass('fa-thumbs-o-up');
                    }
                    // display the number of likes and dislikes
                    $clicked_btn.siblings('span.likes').text(res.likes);
                    $clicked_btn.siblings('span.dislikes').text(res.dislikes);
            
                    // change button styling of the other button if user is reacting the second time to post
                    $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
                }
            }
        });		
    });
    
    // if the user clicks on the dislike button ...
    $('.dislike_btn').on('click', function(){
        var photo_id = $(this).data('id');
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
            action = 'dislike';
        } else if($clicked_btn.hasClass('fa-thumbs-down')){
            action = 'undislike';
        }
        $.ajax({
            url: 'likes.php',
            type: 'post',
            data: {
                'action': action,
                'photo_id': photo_id
            },
            success: function(data){
                if(typeof res != 'object') {
                    let alert_div = document.createElement('div');
                    let close_alert_div = document.createElement('div');
                    alert_div.className = 'alert';
                    close_alert_div.className = 'alert__close';
                    alert_div.innerText = 'Please login if you want to rate the photos.';
                    close_alert_div.innerText = 'X';

                    close_alert_div.addEventListener('click', event => {
                        event.target.parentElement.remove();
                    })

                    alert_div.appendChild(close_alert_div);
                    document.querySelector('body').appendChild(alert_div);
                } else {
                    res = JSON.parse(data);
                    if (action == "dislike") {
                        $clicked_btn.removeClass('fa-thumbs-o-down');
                        $clicked_btn.addClass('fa-thumbs-down');
                    } else if(action == "undislike") {
                        $clicked_btn.removeClass('fa-thumbs-down');
                        $clicked_btn.addClass('fa-thumbs-o-down');
                    }
                    // display the number of likes and dislikes
                    $clicked_btn.siblings('span.likes').text(res.likes);
                    $clicked_btn.siblings('span.dislikes').text(res.dislikes);
                    
                    // change button styling of the other button if user is reacting the second time to post
                    $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
                }
            }
        });	
        
    });
    
});