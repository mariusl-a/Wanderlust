// Method to load images on the front page
$(document).ready(function() {
    // ImageController index will give all images in array json object
    $.get('image', function(data) {
        $.each(data, function(i, item) {
            // Append to the divHomePhotos div
            $('#divHomePhotos').append('<img class="col-md-4 col-xs-12" src="' + item.url + '" />');
        });
    });
});
