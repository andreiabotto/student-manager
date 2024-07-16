import User from './User';

$(document).ready(function() {
    var userService = new User();

    userService.getAllUsers();

    $('#btnsearch').click(function(){
        $('#user-list').empty();
        userService.getFilterUsers().then();
    });

    $('#fields').change(function() {
        if ($(this).val() === 'situacao') {
            $("#iptSearchFor").remove();
            $(this).after(
                '<select name="iptSearchFor" id="iptSearchFor" class="form-select">' +
                '<option value="0">Em análise</option>' +
                '<option value="1">Aprovado</option>' +
                '<option value="2">Reprovado</option>' +
                '</select>'
            );
        }
        else {
            $("#iptSearchFor").remove();
            $(this).after(
                '<input type="search" name="iptSearchFor" id="iptSearchFor" class="form-control" placeholder="Procurar por ..." aria-label="Procurar por ..." aria-describedby="btnsearch">'
            );
        }
    });

});
