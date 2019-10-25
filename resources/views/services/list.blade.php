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
                    <div class="card-header">Servicios</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-primary .navbar-right" data-toggle="modal"
                                        data-target="#modalAdd">Nuevo
                                </button>
                            </div>
                        </div>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-bordered" id="services">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Preparación</th>
                                    <th scope="col">Tiempo</th>
                                    <th scope="col">Profesional</th>
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
    @include('services.regiterModal')

@endsection
<script type="text/javascript">
    $(document).ready(function () {
        loadTable();

        function loadTable() {
            $("tbody tr").remove();
            $.ajax({
                url: "{{ route('service-list') }}",
                method: 'get',
                success: function (data) {
                    console.log(data);
                    $.each(data.services, function (key, service) {
                        var status = (service.is_enabled) ? 'Activo' : 'Inactivo';
                        $('#services tbody').append(
                            '<tr>' +
                            '<td>' + service.name + '</td>' +
                            '<td>' + status + '</td>' +
                            '<td>' + service.preparation + '</td>' +
                            '<td>' + service.time + '</td>' +
                            '<td>' + service.place + '</td>' +
                            '<td>' + '<i class="fa fa-edit" attr-id="' + service.id + '"></i>' + '</td>' +
                            '</tr>'
                        );
                    });
                },
                error: function (error) {
                    $('#places tbody').append('<tr>' +
                        '<td colspan="6" class="text-center">' + error.statusText + "</td>" +
                        "<tr>");
                }
            });

        }

        $('#service-add').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = ($('#id').val() == 0) ? "{{route('service-register')}}" : "{{route('service-update')}}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function (data) {
                    loadTable();
                    $("#service-add").trigger("reset");
                    $('#modalAdd').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();

                    $('.alert-success').text(data.message)
                    $('.alert-success').show();

                },
                error: function (error) {
                    console.log(error.statusText);
                    $('.alert-danger').text(error.statusText);
                    $('.alert-danger').show();
                }
            });
        });

        $('tbody').on('click', '.fa-edit', function (e) {
            e.stopPropagation();
            var id = $(this).attr('attr-id');
            var url = '{{ route('service-get-by-id', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: 'get',
                success: function (data) {
                    $('#name').val(data.service.name);
                    $('#id').val(data.service.id);
                    $('#is_enabled').val(data.service.is_enabled);
                    $('#preparation').val(data.service.preparation);
                    $('#time').val(data.service.time);
                    $('#place_id').val(data.service.place_id);
                    $('#modalAdd').modal('show');
                },
                error: function (error) {
                    console.log(error.statusText);
                }
            });
        })
    });
</script>
