@extends('layouts.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<style>
    .my-custom-scrollbar {
        position: relative;
        height: 450px;
        overflow: auto;
    }

    .table-wrapper-scroll-y {
        display: block;
    }

    .fa-edit {
        cursor: pointer;
    }
</style>
@section('content')
    <div class="container">
        <div class="alert alert-success" style="display: none;" role="alert"></div>
        <div class="alert alert-danger" style="display: none;" role="alert"></div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuarios objeto</div>
                    <div class="card-body">
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-bordered" id="users-object">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('users.modifyModal')
@endsection
<script type="text/javascript">
    $(document).ready(function () {

        var data = {
            "users": [
                {
                    "id": 1,
                    "email": "arturo@cocodigital.co",
                    "first_name": "Arturo",
                    "last_name": "Orozco Osorio"
                },
                {
                    "id": 2,
                    "email": "julian@cocodigital.co",
                    "first_name": "Julián",
                    "last_name": "Garcés Valdivia"
                },
                {
                    "id": 3,
                    "email": "natalia@cocodigital.co",
                    "first_name": "Natalia",
                    "last_name": "Valdivieso"
                },
                {
                    "id": 4,
                    "email": "andrea@cocodigital.co",
                    "first_name": "Andrea",
                    "last_name": "Gonzales"
                },
                {
                    "id": 5,
                    "email": "daniela@cocodigital.co",
                    "first_name": "Daniela",
                    "last_name": "Edwards"
                },
                {
                    "id": 6,
                    "email": "alejandro@cocodigital.co",
                    "first_name": "Alejandro",
                    "last_name": "Otwell"
                }
            ]
        };

        function loadTable() {
            $("tbody tr").remove();
            $.each(data.users, function (key, user) {
                $('#users-object tbody').append(
                    '<tr>' +
                    '<td>' + user.id + '</td>' +
                    '<td>' + user.email + '</td>' +
                    '<td>' + user.first_name + '</td>' +
                    '<td>' + user.last_name + '</td>' +
                    '<td>' + '<i class="fa fa-edit" attr-id="' + user.id + '"></i>' + '</td>' +
                    '</tr>'
                );
            });
        }

        loadTable();

        $('tbody').on('click', '.fa-edit', function (e) {
            e.stopPropagation();
            var id = $(this).attr('attr-id');

            var currentUser = data.users.filter(function (user) {
                return user.id == id;
            });

            $("#id").val(currentUser[0].id);
            $("#email").val(currentUser[0].email);
            $("#first_name").val(currentUser[0].first_name);
            $("#last_name").val(currentUser[0].last_name);
            $('#modalModify').modal('show');
        })

        $("#user-modify").click(function () {
            var id = $('#id').val();
            var userModify = {
                email: $("#email").val(),
                first_name: $("#first_name").val(),
                last_name: $("#last_name").val(),
            };

            $.each(data.users, function (key, user) {
                if (user.id == id) {

                    data.users[key].email = userModify.email;
                    data.users[key].first_name = userModify.first_name;
                    data.users[key].last_name = userModify.last_name;

                    loadTable();

                    $("#user-modify-form").trigger("reset");
                    $('#modalModify').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    return false;
                }
            });
        });
    });
</script>
