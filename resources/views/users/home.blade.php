@extends('layouts.app')

@section('title', 'User manager')

@section('title_card', 'Usuários')

@section('content')
    @include('layouts.users.table')
    @include('layouts.users.modalDetails')
    @include('layouts.users.modalDelete')
@endsection

@section('menu_data')
    @include('layouts.users.menu')
@endsection

@section('scripts')
    <script>
        function showModalDetails(id) {
            try {
                $.ajax({
                    url: '/api/users/' + id,
                    method: 'GET',
                    beforeSend: function() {
                        $('#infoDetails').hide();
                        $('#divDetLoading').show();
                    },
                    success: function(data) {
                        $('#infoDetails').show();
                        $('#divDetLoading').hide();

                        var user = data.data;
                        $('#detName').text(user.name);
                        $('#detEmail').text(user.email);

                        if(user.situacao == 1) { user.situacao = 'Aprovado';}
                        else if(user.situacao == 2) { user.situacao = 'Reprovado';}
                        else{ user.situacao = 'Em análise';}

                        $('#detSituacao').text(user.situacao);
                        $('#detDtAdmission').text(user.admission_date);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } catch (error) {
                console.error(`Error fetching user with id ${id}:`, error);
            }
        }

        function addFunctionToDelete(id) {
            $("#btnDelUserItem").attr('onclick','removeUserItem(' + id + ')');
        }

        function removeUserItem(id) {
            $('#alert-indo-delete').remove();

            try {
                $.ajax({
                    url: '/api/users/' + id,
                    method: 'DELETE',
                    success: function (data) {
                        window.location.reload();
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                        $('#alert-error').append(
                            '<div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-indo-delete">' +
                            'Usuário criado com sucesso' +
                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                            '</div>'
                        );
                    }
                });
            } catch (error) {
                console.error(`Error deleting user with id ${id}:`, error);
            }
        }
    </script>
@endsection
