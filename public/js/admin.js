$(document).ready(function() {
    // Method to get images on the admin page (for Approval of images)
    $.get('admin/data', function(data) {
        if(data.hasOwnProperty('error'))
        {
            // Error occured, redirect to Home
            console.log(data.error);
            window.location.href = "home";
        }
        else
        {
            // Loop each image that is waiting for admin approval
            $.each(data, function(i, item) {
                // Apennd to #divAdminsPhotos
                $('#divAdminPhotos').append('<div class="row photo-' + item.id + '"><div class="col-md-4"><img height="400" width="400" src="' + item.path + '" /></div></div><div class="row photo-' + item.id + '"><div class="col-md-5"><p><strong>Uploaded by <a data-token="{{ csrf_token() }}" href="mailto:'+item.email+'" target="_top">'+item.user_name+'</a></strong></p><a href="#" onclick="event.preventDefault();photoApprove(' + item.id + ')" class="btn btn-primary">Approve photo</a><a href="#" onclick="event.preventDefault();photoDelete(' + item.id + ')" class="btn btn-danger">Delete photo</a></div></div>');
            });
        }
    });
});

// Method to approve photo by ID (Ajax call) - This will update images table and make the photo show on the front page
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

// Method to delete photo (ajax call)
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
