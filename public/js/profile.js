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
                    
                    $('.divInstaPhoto img').mouseover(function() {
                       $(this).fadeTo( "fast", 1 );
                    });
                    
                    $('.divInstaPhoto img').mouseout(function() {
                        $(this).fadeTo( "fast", 0.4 );
                    });
                    
                    $('.divInstaPhoto img').click(function() {
                        photoUpload($(this).attr('src'));
                    });
                    
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Something when wrong when loading instagram photos, please try again soon!');
                }
            });
        }
    });
    
    $('#btn-instagram-disconnect').click(function() {
        $.ajax({
            url: 'instagram',
            type: 'delete',
            data: {_method: 'delete', _token:$('#data-token').val()},
            success: function(result) {}
        });    
    });
    
    
});