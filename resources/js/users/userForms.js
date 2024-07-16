import User from './User';

$(document).ready(function() {
    var userService = new User();

    if (window.location.pathname != '/add') {
        var path = window.location.pathname;
        var segments = path.split('/').filter(segment => segment.length > 0);
        var id = segments.length > 0 ? segments[segments.length - 1] : '';
        userService.getUserById(id);
    }

    $("#btn-add-salvar").click(function(){
        $('#create-user-form').submit();
    })

    $('#create-user-form').submit(function(e){
        e.preventDefault();
        if (window.location.pathname === '/add') {
            userService.createUser($(this));
        }
        else {
            var path = window.location.pathname;
            var segments = path.split('/').filter(segment => segment.length > 0);
            var id = segments.length > 0 ? segments[segments.length - 1] : '';

            userService.updateUser(
                id,
                $(this)
            );
        }
    })


});
