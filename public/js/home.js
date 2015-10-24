$(document).ready(function() {
    $.get('image', function(data) {
        $.each(data, function(i, item) {
            $('#divHomePhotos').append('<img class="col-md-4 col-xs-12" src="' + item.url + '" />');
        });
    });
});