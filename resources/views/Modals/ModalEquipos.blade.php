<div class="modal fade bd-example-modal-xl" id="modal-equipos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary">Crear Ingreso de Equipo</h4>
            </div>
            {!! Form::open(['url' => 'ingresoEquipo', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Tipo Equipo</label>
                            {!! Form::Select('tipo_equipo',$TipoEquipo,null,['class'=>'form-control','id'=>'tipo_equipo','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Tipo Adquisisión</label>
                            {!! Form::Select('tipo_ingreso',$TipoIngreso,null,['class'=>'form-control','id'=>'tipo_ingreso','onChange'=>'mostrar(this.value);','required']) !!}
                        </div>
                        <div class="col-md-3" id="renting" style="display: none;">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Nombre Empresa</label>
                            {!! Form::text('emp_renting',$Renting,['class'=>'form-control','id'=>'emp_renting','placeholder'=>'Nombre Empresa']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Fecha Asignación</label>
                            {!! Form::text('fecha_adquision',$FechaAdquisicion,['class'=>'form-control','id'=>'fecha_adquision','placeholder'=>'Fecha de Asignación']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Serial</label>
                            {!! Form::text('serial',$Serial,['class'=>'form-control','id'=>'serial','placeholder'=>'S/N','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Marca</label>
                            {!! Form::text('marca',$Marca,['class'=>'form-control','id'=>'marca','placeholder'=>'Marca','required']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Procesador</label>
                            {!! Form::text('procesador',$Procesador,['class'=>'form-control','id'=>'procesador','placeholder'=>'Intel / AMD']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Velocidad Procesador</label>
                            {!! Form::text('vel_procesador',$VelProcesador,['class'=>'form-control','id'=>'vel_procesador','placeholder'=>'X.XGhz']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Disco Duro</label>
                            {!! Form::text('disco_duro',$DiscoDuro,['class'=>'form-control','id'=>'disco_duro','placeholder'=>'GB / TB']) !!}
                        </div>
                        <div class="col-md-2">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Memoria RAM</label>
                            {!! Form::text('memoria_ram',$MemoriaRam,['class'=>'form-control','id'=>'memoria_ram','placeholder'=>'GB']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Estado Linea</label>
                            {!! Form::select('estado',$EstadoEquipo,null,['class'=>'form-control','id'=>'estado']) !!}
                        </div>
                        <div class="col-md-5">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Evidencia</label>
                            <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple>
                            <div align="right"><small class="text-muted" style="font-size: 63%;">Tamaño maximo permitido (5MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Crear Ingreso</button>
            </div>
            {!!  Form::close() !!}

        </div>
    </div>
</div>



    <script type="text/javascript">
        function mostrar(id) {
            if (id === '1') {
                $("#renting").show();
                {{-- document.getElementById("emp_renting").required = true; --}}
            }else{
                $("#renting").hide();
                {{-- document.getElementById("emp_renting").required = false; --}}
            }
        }
    </script>
