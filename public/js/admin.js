$(document).ready(function() {
    $.get('admin/data', function(data) {
        if(data.hasOwnProperty('error'))
        {
            console.log(data.error);
            window.location.href = "home";
        }
        else
        {
            $.each(data, function(i, item) {
                $('#divAdminPhotos').append('<div class="row photo-' + item.id + '"><div class="col-md-4"><img height="400" width="400" src="' + item.path + '" /></div></div><div class="row photo-' + item.id + '"><div class="col-md-5"><p><strong>Uploaded by <a data-token="{{ csrf_token() }}" href="mailto:'+item.email+'" target="_top">'+item.user_name+'</a></strong></p><a href="#" onclick="event.preventDefault();photoApprove(' + item.id + ')" class="btn btn-primary">Approve photo</a><a href="#" onclick="event.preventDefault();photoDelete(' + item.id + ')" class="btn btn-danger">Delete photo</a></div></div>');
            });
        }
    });
});
function photoApprove(id) {
    console.log("Approve "+ id);
    $.ajax({
        url: 'admin/data/' + id,
        type: 'PUT',
        data: {_method: 'PUT', _token:$('#data-token').val()},
        success: function(result) {
            console.log(result);
            $('.photo-' + id).hide("slow");
        }
    });   
}

function photoDelete(id) {
    console.log("Delete "+ id);
    $.ajax({
        url: 'admin/data/' + id,
        type: 'delete',
        data: {_method: 'delete', _token:$('#data-token').val()},
        success: function(result) {
            console.log(result);
            $('.photo-' + id).hide("slow");
        }
    });  
}