// Method used when uploading photo fra instagram - by URL
function photoUpload(url) {
    console.log("Uploading "+ url);
    $.ajax({
        url: 'instagram',
        type: 'POST',
        data: {photoUrl: url,_method: 'POST', _token:$('#data-token').val()},
        success: function(result) {
            console.log(result);
        }
    });   
}

$(document).ready(function() {
    var access_token, instagram_username;
    
    // This will get the last 12 images from their instagram account (if an account is connected)
    $.get( 'instagram/0', function(data) {
        if(data.hasOwnProperty('access_token')) {
            access_token = data.access_token;
            instagram_username = data.instagram_username;
            
            $('#instagram_username').val(instagram_username);
            $('#instagram_access_token').val(access_token);
            
            // Load instagram images and show user
            $.ajax({
                method: 'GET',
                url: 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' + access_token + '&count=12',
                dataType: 'jsonp',
                jsonp: 'callback',
                jsonpCallback: 'jsonpcallback',
                success: function(data) {
                    // Loop each image
                    $.each(data.data, function(i, item) {
                        // Append images to the divInstaPhotos for uploading
                        $('#divInstaPhotos').append('<div class="col-md-4 divInstaPhoto"><img src="' + item.images.standard_resolution.url + '" width="300" /><p>' + item.caption.text + '</p></div>');
                    });
                    
                    // Mouseover effect to fade in the color
                    $('.divInstaPhoto img').mouseover(function() {
                       $(this).fadeTo( "fast", 1 );
                    });
                    
                    // Mouseout effect to fadeout color
                    $('.divInstaPhoto img').mouseout(function() {
                        $(this).fadeTo( "fast", 0.4 );
                    });
                    
                    // Activates the click event for each image for instagram upload
                    $('.divInstaPhoto img').click(function() {
                        photoUpload($(this).attr('src'));
                    });
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // Maybe instagram API has some problems? 
                    alert('Something when wrong when loading instagram photos, please try again soon!');
                }
            });
        }
    });
    
    // Button is "hidden" - But a user would be able to remove the instagram connection
    $('#btn-instagram-disconnect').click(function() {
        $.ajax({
            url: 'instagram',
            type: 'delete',
            data: {_method: 'delete', _token:$('#data-token').val()},
            success: function(result) {}
        });    
    });
    
    
});
