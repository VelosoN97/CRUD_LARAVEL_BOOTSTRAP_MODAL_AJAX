@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="AgregaJugadorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Jugador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul id="saveform_errList"></ul>

                    <div class="form-group mb-3">
                        <label for="">Nombre Jugador</label>
                        <input type="text" class="nombre form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" class="email form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Fecha de Nacimiento</label>
                        <input type="date" class="fecha_nac form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Equipo</label>
                        <input type="text" class="equipo form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Posición</label>
                        <input type="text" class="posicion form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary agregar_jugador">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!--EditarModal !-->
    <div class="modal fade" id="EditarJugadorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Jugador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <ul id="updateform_errList"></ul>

                    <input type="hidden" id="editar_jug_id">

                    <div class="form-group mb-3">
                        <label for="">Nombre Jugador</label>
                        <input type="text" id="editar_nombre" class="nombre form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" id="editar_email" class="email form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Fecha de Nacimiento</label>
                        <input type="date" id="editar_fecha" class="fecha_nac form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Equipo</label>
                        <input type="text" id="editar_equipo" class="equipo form-control">
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Posición</label>
                        <input type="text" id="editar_posicion" class="posicion form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary update_jugador">Editar</button>
                </div>
            </div>
        </div>
    </div>
    <!--FinalizarEditarModal !-->

    <!--EliminarModal !-->
    <div class="modal fade" id="EliminarJugadorModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar Jugador</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">                  

                    <input type="hidden" id="eliminar_jug_id">
                    <h4>¿Está seguro? ¿Quieres eliminar estos datos?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary eliminar_jugador_btn">Sí Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <!--FinalizarEliminarModal !-->

    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">

                <div id="success_message"></div>

                <div class="card">
                    <div class="card-header">
                        <h4>Gestión de Jugadores</h4>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#AgregaJugadorModal"
                            class="btn btn-primary float-end btn-sm">Agregar Jugador</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Email</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Equipo</th>
                                    <th>Posición</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            fetchjugador();
            function fetchjugador(){
                $.ajax({
                    type: "GET",
                    url: "/fetch-jugadores",
                    dataType: "json",
                    success: function(response){
                        //console.log(response.jugadores);
                        $('tbody').html("");
                        $.each(response.jugadores, function(key, item){
                            $('tbody').append('<tr>\
                                    <td>'+item.id+'</td>\
                                    <td>'+item.nombre+'</td>\
                                    <td>'+item.email+'</td>\
                                    <td>'+item.fecha_nac+'</td>\
                                    <td>'+item.equipo+'</td>\
                                    <td>'+item.posicion+'</td>\
                                    <td><button type="button" value="'+item.id+'" class="editar_jugador btn btn-primary btn-sm">Editar</button></td>\
                                    <td><button type="button" value="'+item.id+'" class="eliminar_jugador btn btn-danger btn-sm">Eliminar</button></td>\
                                </tr>');
                        });
                    }
                });
            }

            $(document).on('click', '.eliminar_jugador', function(e){
                e.preventDefault();
                var jug_id = $(this).val();
                //alert(jug_id);
                $('#eliminar_jug_id').val(jug_id);
                $('#EliminarJugadorModal').modal('show');
            });

            $(document).on('click', '.eliminar_jugador_btn', function(e){
                e.preventDefault();
                $(this).text("Eliminando..");
                var jug_id = $('#eliminar_jug_id').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "DELETE",
                    url: "/eliminar-jugador/"+jug_id,
                    success: function(response){
                        //console.log(response);
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(response.message);
                        $('#EliminarJugadorModal').modal('hide');
                        $('.eliminar_jugador_btn').text("Sí Eliminar");
                        fetchjugador();
                    }
                });
            });
        
            $(document).on('click', '.editar_jugador', function(e){
                e.preventDefault();
                var jug_id = $(this).val();
                //console.log(jug_id);
                $('#EditarJugadorModal').modal('show');
                $.ajax({
                    type: "GET",
                    url: "/editar-jugador/"+jug_id,
                    success: function(response){
                        //console.log(response);
                        if(response.status == 404){
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-danger');
                            $('#success_message').text(response.message);
                        } else {
                            $('#editar_nombre').val(response.jugador.nombre);
                            $('#editar_email').val(response.jugador.email);
                            $('#editar_fecha').val(response.jugador.fecha_nac);
                            $('#editar_equipo').val(response.jugador.equipo);
                            $('#editar_posicion').val(response.jugador.posicion);
                            $('#editar_jug_id').val(jug_id);
                        }
                    }
                });
            });

            $(document).on('click', '.update_jugador', function(e){
                e.preventDefault();
                $(this).text("Actualizando..");
                var jug_id = $('#editar_jug_id').val();
                var data = {
                    'nombre' : $('#editar_nombre').val(),
                    'email' : $('#editar_email').val(),
                    'fecha_nac' : $('#editar_fecha').val(),
                    'equipo' : $('#editar_equipo').val(),
                    'posicion' : $('#editar_posicion').val()
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "PUT",
                    url: "/update-jugador/"+jug_id,
                    data: data,
                    dataType: "json",
                    success: function(response){
                        //console.log(response);
                        if(response.status == 400){
                            $('#updateform_errList').html("");
                            $('#updateform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values){
                                $('#updateform_errList').append('<li>'+err_values+'</li>');
                            });
                            $('.update_jugador').text("Actualizar");
                        } else if(response.status == 404){
                            $('#updateform_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                        } else {
                            $('#updateform_errList').html("");
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#EditarJugadorModal').modal('hide');
                            $('.update_jugador').text("Actualizar");
                            fetchjugador();
                        }
                    }
                });
            });

            $(document).on('click', '.agregar_jugador', function(e) {
                e.preventDefault();
                var data = {
                    'nombre': $('.nombre').val(),
                    'email': $('.email').val(),
                    'fecha_nac': $('.fecha_nac').val(),
                    'equipo': $('.equipo').val(),
                    'posicion': $('.posicion').val(),
                }
                //console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "/jugadores",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        //console.log(response);
                        if(response.status == 400){
                            $('#saveform_errList').html("");
                            $('#saveform_errList').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values){
                                $('#saveform_errList').append('<li>'+err_values+'</li>');
                            });
                        } else {
                            $('#saveform_errList').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(response.message);
                            $('#AgregaJugadorModal').modal('hide');
                            $('#AgregaJugadorModal').find('input').val("");
                            fetchjugador();
                        }
                    }
                });
            });
        });
    </script>
@endsection
