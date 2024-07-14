$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
    // Fetch users
    $('#fetch-users').click(function() {
        $.ajax({
            url: '/users',
            method: 'GET',
            success: function(data) {
                $('#user-list').empty();
                $.each(data.data, function(index, user) {
                    $('#user-list').append('<li>' + user.name + ' (' + user.email + ')</li>');
                });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // Create user
    $('#create-user-form').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/users',
            method: 'POST',
            data: $(this).serialize(),
            success: function(data) {
                alert('User created successfully!');
                $('#create-user-form')[0].reset();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
