<div class="modal fade bd-example-modal-xl" id="modal-update-novedad" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title modal-title-primary"><b>Actualización de Novedad</b></h4>
            </div>
            {!! Form::open(['url' => 'actualizarNovedadMobile', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-body">
                    <input type="hidden" name="idNM" id="mod_idNM">
                    <input type="hidden" name="NroLinea" id="mod_NroLinea">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Año</label>
                                {!! Form::select('yearNovedad',$ListYear,null,['class'=>'form-control','id'=>'mod_yearNovedad']) !!}
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Año</label>
                                {!! Form::select('monthNovedad',$ListMonth,null,['class'=>'form-control','id'=>'mod_monthNovedad']) !!}
                            </div>
                            <div class="col-md-4">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Valor Mes</label>
                                {!! Form::text('valorMes',$Valor,['class'=>'form-control','id'=>'mod_valorMes','placeholder'=>'Novedad del valor del mes']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="exampleInputEmail1" class="col-sm-12 control-label">Novedad</label>
                                {!! Form::textarea('novedadMes',$Novedad,['class'=>'form-control','id'=>'mod_novedadMes','placeholder'=>'Ingrese la descripción de la novedad','rows'=>'3']) !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar Novedad</button>
                </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
    <script>

        function obtener_update_novedad(id) {

            var YearNovedad     = $("#year"+ id).val();
            var MonthNovedad    = $("#mes"+ id).val();
            var ValorNovedad    = $("#valor_mes"+ id).val();
            var NovedadMes      = $("#novedad_mes"+ id).val();
            var NroLinea        = $("#NroLinea"+ id).val();

            $("#mod_idNM").val(id);
            $("#mod_yearNovedad").val(YearNovedad);
            $("#mod_monthNovedad").val(MonthNovedad);
            $("#mod_valorMes").val(ValorNovedad);
            $("#mod_novedadMes").val(NovedadMes);
            $("#mod_NroLinea").val(NroLinea);
        }
    </script>
