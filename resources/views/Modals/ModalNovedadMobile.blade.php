<div class="modal fade bd-example-modal-xl" id="modal-agregar-novedadMobile" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary"><b>Crear Novedad de Equipo Movil</b></h4>
            </div>
            {!! Form::open(['url' => 'agregarNovedadMovil', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
            <div class="modal-body">
                <input type="hidden" name="IdUsuario" id="IdUsuario" value="{!! Session::get('IdUsuario') !!}">
                <input type="hidden" name="idMNov" id="mod_idMNov">
                <input type="hidden" name="LineaMovil" id="mod_LineaMovil">
                <div class="form-group">
                    <input type="hidden" name="idUsuarioInv" id="mod_idUsuarioInv">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 2vh;">Año</label>
                            {!! Form::select('yearNovedad',$ListYear,null,['class'=>'form-control','id'=>'yearNovedad']) !!}
                        </div>
                        <div class="col-md-3">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 2vh;">Mes</label>
                            {!! Form::select('mesNovedad',$ListMonth,null,['class'=>'form-control','id'=>'mesNovedad']) !!}
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 2vh;">Valor Mes</label>
                            {!! Form::text('valor_mes',$Valor,['class'=>'form-control','id'=>'valor_mes','placeholder'=>'Novedad del valor del mes']) !!}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="exampleInputEmail1" class="col-sm-12 control-label" style="font-size: 2vh;">Novedad</label>
                            {!! Form::textarea('novedad',$Novedad,['class'=>'form-control','id'=>'novedad','placeholder'=>'Ingrese la descripción de la novedad','rows'=>'3']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Crear Novedad</button>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
    <script>

        function obtener_datos_novedadMobile(id) {
            $("#mod_idMNov").val(id);
            var NroLinea        = $("#NroLinea"+ id).val();
            $("#mod_LineaMovil").val(NroLinea);
        }
    </script>
