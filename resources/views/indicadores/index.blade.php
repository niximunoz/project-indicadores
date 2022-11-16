<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros UF</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
   

</head>

<body>
    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Información Historica UF</a>
        </div>
    </nav>

    <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Lista UF</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Registrar UF</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" id="btnMostrar" name="btnMostrar" type="button">Consumir API Indicadores</button>
                </div>
                <!-- Tabla  indicador-->
                <table id="tabla-indicadores" class="table table-hover">
                    <thead>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Codigo</th>
                        <th>Unidad</th>
                        <th>Valor </th>
                        <th>Fecha</th>
                        <th>Origen</th>
                        <th>Acciones</th>
                    </thead>
                </table>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <br><!-- Registro indicador-->
                <form id="registro-indicadores">
                    @csrf
                    <div class="form-group">
                        <label for="">Nombre</label>
                        <input type="text" class="form-control" id="nom_ind" name="nom_ind" required>
                        <label for="">Codigo Indicador</label>
                        <input type="text" disabled class="form-control" id="cod_ind" name="cod_ind" value="UF">
                        <label for="">Unidad medida Indicador</label>
                        <input type="text" disabled class="form-control" id="um_ind" name="um_ind" value="Pesos">
                        <label for="">Valor Indicador</label>
                        <input type="number" class="form-control" id="valor_ind" name="valor_ind" required>
                        <label for="">Fecha Indicador</label>
                        <input type="date" class="form-control" id="fech_ind" name="fech_ind" required>
                        <label for="">Origen Indicador</label>
                        <input type="text/html" class="form-control" id="ori_ind" name="ori_ind" required>
                    </div>
                    <div><br>
                        <button type="submit" class="w-100 btn btn-lg btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal editar indicador-->
        <div class="modal" id="editar_modal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editar_form">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" id="id2" name="id2">
                                <label for="">Nombre</label>
                                <input type="text" class="form-control" id="nom_ind2" name="nom_ind2">
                                <label for="">Codigo Indicador</label>
                                <input type="text" disabled class="form-control" id="cod_ind2" name="um_ind2">
                                <label for="">Unidad medida Indicador</label>
                                <input type="text" disabled class="form-control" id="um_ind2" name="um_ind2">
                                <label for="">Valor Indicador</label>
                                <input type="text" class="form-control" id="valor_ind2" name="valor_ind2">
                                <label for="">Fecha Indicador</label>
                                <input type="date" class="form-control" id="fech_ind2" name="fech_ind2">
                                <label for="">Origen Indicador</label>
                                <input type="href" class="form-control" id="ori_ind2" name="ori_ind2">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal eliminar -->
        <div class="modal" id="confirmModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Eliminar Registro</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Desea eliminar el registro seleccionado?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" id="btnEliminar" name="btnEliminar" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        
    <script>
        //Mostrar datos indicadores
        $(document).ready(function() {
            var tablaIndicadores = $('#tabla-indicadores').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('indicadores.index')}}",
                },
                columns: [{
                        data: 'ID'
                    },
                    {
                        data: 'nombreIndicador'
                    },
                    {
                        data: 'codigoIndicador'
                    },
                    {
                        data: 'unidadMedidaIndicador'
                    },
                    {
                        data: 'valorIndicador'
                    },
                    {
                        data: 'fechaIndicador'
                    },
                    {
                        data: 'origenIndicador'
                    },
                    {
                        data: 'action',
                        orderable: false
                    }
                ]
            });
        });
    </script>
    <script>
        //Registrar nuevo indicador
        $('#registro-indicadores').submit(function(e) {
            e.preventDefault();
            var nombreIndicador = $('#nom_ind').val();
            var codigoIndicador = $('#cod_ind').val();
            var unidadMedidaIndicador = $('#um_ind').val();
            var valorIndicador = $('#valor_ind').val();
            var fechaIndicador = $('#fech_ind').val();
            var origenIndicador = $('#ori_ind').val();
            var _token = $("input[name=_token").val();

            $.ajax({
                url: "{{route('indicadores.registrar')}}",
                type: "POST",
                data: {
                    nombreIndicador: nombreIndicador,
                    codigoIndicador: codigoIndicador,
                    unidadMedidaIndicador: unidadMedidaIndicador,
                    valorIndicador: valorIndicador,
                    fechaIndicador: fechaIndicador,
                    origenIndicador: origenIndicador,
                    _token: _token,
                },
                success: function(response) {
                    if (response) {
                        $('#registro-indicadores')[0].reset();
                        toastr.success('El registro se ingreso correctamente.', 'Nuevo Registro', {
                            timeOut: 3000
                        });
                        $('#tabla-indicadores').DataTable().ajax.reload();
                    }
                }
            });
        });
    </script>
    <script>
        //Eliminar indicador
        var id_ind;
        $(document).on('click', '.delete', function() {
            id_ind = $(this).attr('id');
            $('#confirmModal').modal('show');

        });
        $('#btnEliminar').click(function() {
            $.ajax({
                url: "indicadores/eliminar/" + id_ind,
                beforeSend: function() {
                    $('#btnEliminar').text('Eliminando...');
                },
                success: function(data) {
                    setTimeout(function() {
                        $('#confirmModal').modal('hide');
                        toastr.warning('El registro fue eliminado correctamente.',
                            'Eliminar Registro', {
                                timeOut: 2000
                            });
                        $('#tabla-indicadores').DataTable().ajax.reload();
                    }, 1000);
                }
            });
        });
    </script>
    <script>
        //Editar Indicador
        function editarIndicadores(id) {
            $.get('indicadores/editar/' + id, function(indicadores) {
                $('#id2').val(indicadores[0].id)
                $('#nom_ind2').val(indicadores[0].nombreIndicador)
                $('#cod_ind2').val(indicadores[0].codigoIndicador)
                $('#um_ind2').val(indicadores[0].unidadMedidaIndicador)
                $('#valor_ind2').val(indicadores[0].valorIndicador)
                $('#fech_ind2').val(indicadores[0].fechaIndicador)
                $('#ori_ind2').val(indicadores[0].origenIndicador)

                $('#editar_modal').modal('toggle');
            })
        }
    </script>
    <script>
        //Actualizar registro
        $('#editar_form').submit(function(e) {
            e.preventDefault();
            var id2 = $('#id2').val();
            var nombreIndicador2 = $('#nom_ind2').val();
            var codigoIndicador2 = $('#cod_ind2').val();
            var unidadMedidaIndicador2 = $('#um_ind2').val();
            var valorIndicador2 = $('#valor_ind2').val();
            var fechaIndicador2 = $('#fech_ind2').val();
            var origenIndicador2 = $('#ori_ind2').val();
            var _token2 = $("input[name=_token]").val();
            $.ajax({
                url: "indicadores/actualizar",
                type: "POST",
                data: {
                    id: id2,
                    nombreIndicador: nombreIndicador2,
                    codigoIndicador: codigoIndicador2,
                    unidadMedidaIndicador: unidadMedidaIndicador2,
                    valorIndicador: valorIndicador2,
                    fechaIndicador: fechaIndicador2,
                    origenIndicador: origenIndicador2,
                    _token: _token2,
                },
                success: function(response) {
                    if (response) {
                        $('#editar_modal').modal('hide');
                        toastr.info('El registro fue actualizado correctamente.',
                            'Actualizar Registro', {
                                timeOut: 3000
                            });
                        $('#tabla-indicadores').DataTable().ajax.reload();
                    }
                }
            })
        });
    </script>
    <script>
        //Mostrar datos de API
        $('#btnMostrar').click(function() {
            $.ajax({
                url: "indicadores/mostrar",
                beforeSend: function(data) {
                    setTimeout(function() {
                        $('#btnMostrar').prop('disabled', true);
                        toastr.info('Debe recargar la pagina para actualizar los datos obtenidos',
                            'Indicadores', {
                                timeOut: 2000
                            });
                        $('#tabla-indicadores').DataTable().ajax.reload();
                    }, 1000);
                }
            });
        });
    </script>
    
</body>

</html>