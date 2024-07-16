import Swal from "sweetalert2";

class User {

    baseUrl = '/api';
    headers = {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    };

    async getAllUsers() {
        try {
            var classe = this;

            $.ajax({
                url: this.baseUrl + '/users',
                method: 'GET',
                beforeSend: function() {
                    $('#user-list').empty();
                    $('#user-list').append(
                        classe.rowWithLoadingData()
                    );
                },
                success: function(data) {
                    $('#user-list').empty();
                    if(data.data.length > 0) {
                        $.each(data.data, function (index, user) {
                            $('#user-list').append(
                                classe.rowWithUserContent(user)
                            );
                        });
                    } else {
                        $('#user-list').append(
                            classe.rowWithNoData()
                        );
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    }

    async getFilterUsers() {
        try {
            var classe = this;
            var fieldSelect = $('#fields :selected').val();
            var valueSearchFor =  $('#iptSearchFor').val();

            $.ajax({
                url: this.baseUrl + '/users',
                method: 'GET',
                data: {
                    'values': [
                        fieldSelect, valueSearchFor
                    ]
                },
                beforeSend: function() {
                    $('#user-list').empty();
                    $('#user-list').append(
                        classe.rowWithLoadingData()
                    );
                },
                success: function (data) {
                    $('#user-list').empty();
                    if(data.data.length > 0) {
                        $.each(data.data, function (index, user) {
                            $('#user-list').append(
                                classe.rowWithUserContent(user)
                            );
                        });
                    } else {
                        $('#user-list').append(
                            classe.rowWithNoData()
                        );
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        } catch (error) {
            console.error('Error fetching users:', error);
        }
    }

    async getUserById(id) {
        try {
            $.ajax({
                url: this.baseUrl + '/users/' + id,
                method: 'GET',
                success: function(data) {
                    var user = data.data;

                    $('#name').val(user.name);
                    $('#email').val(user.email);
                    $('#situacao').val(user.situacao);
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        } catch (error) {
            console.error(`Error fetching user with id ${id}:`, error);
        }
    }

    async createUser(form) {
        try {

            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();

            $.ajax({
                url: this.baseUrl + '/users',
                method: 'POST',
                data: $(form).serialize(),
                success: function (data) {
                    $('input').val('');

                    Swal.fire("Usuário cadastrado com sucesso");
                },
                fail: function (error) {
                  console.error(error);
                },
                error: function (xhr) {
                    var message = xhr.responseText;
                    message = JSON.parse(message);

                    Swal.fire({
                        icon: "error",
                        title: "Dados inválidos"
                    });

                    if(message['errors']) {
                        var msgs = message['errors'];
                        var messages = Object.entries(msgs);

                        for (let i = 0; i < messages.length; i++) {
                            var input = messages[i][0];
                            var txt = messages[i][1];

                            $('input[name="' + input + '"]')
                                .addClass('is-invalid')
                                .after(
                                    '<div id="validation' + input + 'Feedback" class="invalid-feedback">' +
                                    txt +
                                    '</div>'
                                );
                        }
                    }

                    console.error(xhr.responseText);
                }
            });
        } catch (error) {
            console.error('Error creating user:', error);
        }
    }

    async updateUser(id, form) {
        try {
            $.ajax({
                url: this.baseUrl + '/users/' + id,
                method: 'PUT',
                data: $(form).serialize(),
                success: function (data) {
                    Swal.fire("Usuário editado com sucesso");
                },
                error: function (xhr) {
                    var message = xhr.responseText;
                    message = JSON.parse(message);

                    Swal.fire({
                        icon: "error",
                        title: "Dados inválidos"
                    });

                    if(message['errors']) {
                        var msgs = message['errors'];
                        var messages = Object.entries(msgs);

                        for (let i = 0; i < messages.length; i++) {
                            var input = messages[i][0];
                            var txt = messages[i][1];

                            $('input[name="' + input + '"]')
                                .addClass('is-invalid')
                                .after(
                                    '<div id="validation' + input + 'Feedback" class="invalid-feedback">' +
                                    txt +
                                    '</div>'
                                );
                        }
                    }
                    console.error(xhr.responseText);
                }
            });
        } catch (error) {
            console.error(`Error updating user with id ${id}:`, error);
        }
    }

    async deleteUser(id) {
        try {
            $.ajax({
                url: this.baseUrl + '/users',
                method: 'DELETE',
                data: $(this).serialize(),
                success: function (data) {

                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                }
            });
        } catch (error) {
            console.error(`Error deleting user with id ${id}:`, error);
        }
    }

    checkClassSituation(status) {
        var params = [];
        switch (status) {
            case 1:
                params[0] = 'text-bg-success';
                params[1] = 'Aprovado';
                break;
            case 2:
                params[0] = 'text-bg-danger';
                params[1] = 'Reprovado';
                break;
            default:
                params[0] = 'text-bg-warning';
                params[1] = 'Em análise';
                break;
        }

        return params;
    }

    rowWithUserContent(user) {
        var classe = this;
        var status = classe.checkClassSituation(user.situacao);

        return '<tr>' +
        '<td>' + user.id + '</td>' +
        '<td>' + user.name + '</td>' +
        '<td>' + user.email + '</td>' +
        '<td>' +
        '<span class="badge '+ status[0] +'">' +
        status[1] +
        '</span>' +
        '</td>' +
        '<td>' + user.admission_date + '</td>' +
        '<td>' +
        '<div>' +
        '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetails" onclick="showModalDetails(' + user.id + ')">' +
        '<i class="bi bi-search"></i>' +
        '</button>' +
        '<a href="/edit/' + user.id + '" class="btn btn-success ms-1">' +
        '<i class="bi bi-pencil-square"></i>' +
        '</a>' +
        '<button type="button" class="btn btn-danger ms-1" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="addFunctionToDelete(' + user.id +')">' +
        '<i class="bi bi-trash"></i>' +
        ' </button>' +
        '</div>' +
        '</td>' +
        '</tr>'
    }

    rowWithNoData() {
        return '<tr>' +
            '<td colSpan="6">' +
            '<div style="text-align: center;">' +
            '<div>' +
            '<span>Nenhum dado encontrado</span>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '</tr>';
    }

    rowWithLoadingData() {
        return '<tr>' +
            '<td colSpan="6">' +
            '<div style="text-align: center;">' +
            '<div class="spinner-border text-primary" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>' +
            '</div>' +
            '</td>' +
            '</tr>';
    }



}

export default User;
