<div class="modal fade bd-example-modal-xl" id="modal-solicitud"  tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="color: white;background-color: rgba(162, 27, 37, 1);">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Ticket</h4>
            </div>
                {!! Form::open(['action' => 'Usuario\UsuarioController@nuevaSolicitud', 'method' => 'post', 'enctype' => 'multipart/form-data','autocomplete'=>'off']) !!}
                    <div class="modal-body">
                        <fieldset>
                            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label col-sm-12" for="fname">Nombre Completo:</label>
                                        {!! Form::text('nombre_usuario',null,['class'=>'form-control','id'=>'nombre_usuario','placeholder'=>'Nombres y Apellidos','required']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label col-sm-12" for="fname">Telefóno:</label>
                                        {!! Form::text('telefono_usuario',null,['class'=>'form-control','id'=>'telefono_usuario','placeholder'=>'No. de telefóno del reportante','required']) !!}
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label col-sm-12" for="fname">Correo Electrónico:</label>
                                        {!! Form::email('correo_usuario',null,['class'=>'form-control','id'=>'correo_usuario','placeholder'=>'Correo electrónico corporativo','required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label col-sm-12" for="fname">Sede:</label>
                                        <input type="text" class="form-control" id="sede" name="sede" placeholder="Sede" value="{!! Session::get('NombreSede') !!}" readonly>
                                        <input type="hidden" class="form-control" id="project_id" name="project_id" placeholder="Sede" value="{!! Session::get('Sede') !!}" readonly>
                                        {{--  {!! Form::select('project_id',$Sedes,null,['class'=>'form-control','id'=>'project_id','onchange'=>'Area();','required']) !!}  --}}
                                    </div>
                                    <div class="col-md-5">
                                        <label class="control-label col-sm-12" for="fname">Área / Dependencia:</label>
                                        <input type="text" class="form-control" id="dependencia" name="dependencia" placeholder="Area" value="{!! Session::get('NombreArea') !!}" readonly>
                                        <input type="hidden" class="form-control" id="area" name="area" placeholder="Area" value="{!! Session::get('Area') !!}" readonly>
                                        {{--  {!! Form::text('dependencia',null,['class'=>'form-control','id'=>'dependencia','required','placeholder'=>'Área u oficina del usuario']) !!}  --}}
                                        {{--  {!! Form::select('area',$Areas,null,['class'=>'form-control','id'=>'area','required']) !!}  --}}
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label col-sm-12" for="email">Tipo Ticket:</label>
                                        {!! Form::select('kind_id',$Tipo,null,['class'=>'form-control','id'=>'kind_id','required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label class="control-label col-sm-12" for="email">Asunto</label>
                                        {!! Form::select('asunto',$TicketRecurrente,null,['class'=>'form-control','id'=>'asunto','required','onChange'=>'mostrar(this.value);']) !!}
                                    </div>
                                    <div class="col-md-7" id="titulo" style="display: none;">
                                        <label class="control-label col-sm-12" for="email">Cuál?</label>
                                        {!! Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'Asunto del Ticket']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12" id="titulo" style="display: none;">
                                        <label class="control-label col-sm-12" for="email">Cuál?</label>
                                        {!! Form::text('title',null,['class'=>'form-control','id'=>'title','placeholder'=>'Asunto del Ticket']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label class="control-label col-sm-12" for="comment">Descripción de la Solicitud:</label>
                                        {!! Form::textarea('description',null,['class'=>'form-control','id'=>'description','placeholder'=>'Ingrese la descripción de la solicitud','rows'=>'3','required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label for="exampleInputEmail1" class="col-sm-12 control-label">Anexar Evidencia al Ticket</label>
                                        <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple="multiple" size="5120">
                                        <div align="right"><small class="text-muted" style="font-size: 73%;">Tamaño maximo permitido (5MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Crear Ticket</button>
                    </div>
                {!!  Form::close() !!}
            </div>
        </div>
    </div>
</div>

