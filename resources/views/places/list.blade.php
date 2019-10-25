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
                    <div class="card-header">Profesionales</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="button" class="btn btn-primary .navbar-right" data-toggle="modal"
                                        data-target="#modalAdd">Nuevo
                                </button>
                            </div>
                        </div>
                        <div class="table-wrapper-scroll-y my-custom-scrollbar">
                            <table class="table table-bordered" id="places">
                                <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Compañia</th>
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
    @include('places.regiterModal')

@endsection
<script type="text/javascript">
    $(document).ready(function () {
        loadTable();

        function loadTable() {
            $("tbody tr").remove();
            $.ajax({
                url: "{{ route('place-list') }}",
                method: 'get',
                success: function (data) {
                    $.each(data.places, function (key, place) {
                        var status = (place.is_active) ? 'Activo' : 'Inactivo';
                        $('#places tbody').append(
                            '<tr>' +
                            '<td>' + place.name + '</td>' +
                            '<td>' + status + '</td>' +
                            '<td>' + place.company + '</td>' +
                            '<td>' + '<i class="fa fa-edit" attr-id="' + place.id + '"></i>' + '</td>' +
                            '</tr>'
                        );
                    });
                },
                error: function (error) {
                    $('#places tbody').append('<tr>' +
                        '<td colspan="4" class="text-center">' + error.statusText + "</td>" +
                        "<tr>");
                }
            });
        }

        $('#place-add').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = ($('#id').val() == 0) ? "{{route('place-register')}}" : "{{route('place-update')}}";

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
                    $("#place-add").trigger("reset");
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
            var url = '{{ route('place-get-by-id', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                url: url,
                method: 'get',
                success: function (data) {
                    $('#name').val(data.place.name);
                    $('#id').val(data.place.id);
                    $('#is_active').val(data.place.is_active);
                    $('#company_id').val(data.place.company_id);
                    $('#modalAdd').modal('show');
                },
                error: function (error) {
                    console.log(error.statusText);
                }
            });
        })
    });
</script>
