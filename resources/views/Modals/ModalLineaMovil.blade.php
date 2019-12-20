<div class="modal fade bd-example-modal-xl" id="modal-linea-movil" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary">Crear Ingreso de Linea Movil</h4>
            </div>
            {!! Form::open(['url' => 'asignacionLineaMovil', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            {{--  <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Tipo Equipo</label>
                            {!! Form::select('tipo_equipo',$TipoEquipo,null,['class'=>'form-control','id'=>'tipo_equipo']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Asignación</label>
                            {!! Form::text('fecha_adquision',$FechaAdquisicion,['class'=>'form-control','id'=>'fecha_adquision','placeholder'=>'Fecha de Asignación del Equipo']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Serial</label>
                            {!! Form::text('serial',$Serial,['class'=>'form-control','id'=>'serial','placeholder'=>'S/N','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Marca</label>
                            {!! Form::text('marca',$Marca,['class'=>'form-control','id'=>'plan','placeholder'=>'Marca Equipo']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Modelo</label>
                            {!! Form::text('modelo',$Modelo,['class'=>'form-control','id'=>'modelo','placeholder'=>'Modelo del Equipo']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">IMEI</label>
                            {!! Form::text('imei',$IMEI,['class'=>'form-control','id'=>'imei','placeholder'=>'IMEI','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Capacidad GB</label>
                            {!! Form::text('capacidad',$Capacidad,['class'=>'form-control','id'=>'capacidad','placeholder'=>'Capacidad de Memoria en GB']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Nro. Linea</label>
                            {!! Form::Select('linea_movil',$LineaMovil,null,['class'=>'form-control','id'=>'linea_movil']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Area</label>
                            {!! Form::text('area',$Area,['class'=>'form-control','id'=>'area','placeholder'=>'Area del usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Asignado</label>
                            {!! Form::text('nombre_asignado',$NombreAsignado,['class'=>'form-control','id'=>'nombre_asignado','placeholder'=>'Nombre del Usuario']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Estado Equipo</label>
                            {!! Form::select('estado',$EstadoEquipo,null,['class'=>'form-control','id'=>'estado']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Evidencia</label>
                            <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple>
                        </div>
                    </div>
                </div>
            </div>  --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Crear Ingreso</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>
