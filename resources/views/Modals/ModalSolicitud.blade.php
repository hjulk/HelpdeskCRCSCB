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
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="contact-info">
                                {{--  <img src="{{asset("assets/Solicitud/support.png")}}" alt="image"/>  --}}
                                <h2 style="color:white;">Crear Ticket</h2>
                                <h4 style="color:white;">Tenga en cuenta:</h4>
                                <br>

                                <p style="color:white;font-size:2.2vh;text-align:justify;">
                                    <b>Incidente: </b>Es cualquier evento que interrumpa el funcionamiento normal de un servicio afectando ya sea a uno, a un grupo o a todos los usuarios de un servicio, un incidente se puede tomar como la reducción en la calidad de un servicio IT.<br>
                                </p>
                                <p style="color:white;font-size:2.2vh;text-align:justify;">
                                    <b>Requerimiento: </b>Se define como una solicitud formal por parte de un usuario para que algo sea provisto, como por ejemplo Instalaciones, movimientos, adiciones o cambios en los elementos o servicios provistos por la Dirección de TIC.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="contact-form">

                                <fieldset>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label class="control-label col-sm-12" for="fname">Nombre Completo:</label>
                                            {!! Form::text('nombre_usuario',null,['class'=>'form-control','id'=>'nombre_usuario','placeholder'=>'Nombres y Apellidos','required']) !!}
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="control-label col-sm-12" for="fname">Telefóno:</label>
                                            {!! Form::text('telefono_usuario',null,['class'=>'form-control','id'=>'telefono_usuario','placeholder'=>'No. de telefóno del reportante','required']) !!}
                                        </div>
                                        <div class="col-sm-5">
                                            <label class="control-label col-sm-12" for="fname">Correo Electrónico:</label>
                                            {!! Form::email('correo_usuario',null,['class'=>'form-control','id'=>'correo_usuario','placeholder'=>'Correo electrónico corporativo','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label class="control-label col-sm-12" for="fname">Sede:</label>
                                            {!! Form::select('project_id',$Sedes,null,['class'=>'form-control','id'=>'project_id','onchange'=>'Area();','required']) !!}
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="control-label col-sm-12" for="fname">Área / Dependencia:</label>
                                            {{--  {!! Form::text('dependencia',null,['class'=>'form-control','id'=>'dependencia','required','placeholder'=>'Área u oficina del usuario']) !!}  --}}
                                            {!! Form::select('area',$Areas,null,['class'=>'form-control','id'=>'area','required']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <label class="control-label col-sm-12" for="email">Tipo Ticket:</label>
                                            {!! Form::select('kind_id',$Tipo,null,['class'=>'form-control','id'=>'kind_id','required']) !!}
                                        </div>
                                        <div class="col-sm-9">
                                            <label class="control-label col-sm-12" for="email">Asunto</label>
                                            {!! Form::select('asunto',$TicketRecurrente,null,['class'=>'form-control','id'=>'asunto','required','onChange'=>'mostrar(this.value);']) !!}
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
                                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <label for="exampleInputEmail1" class="col-sm-12 control-label">Anexar Evidencia al Ticket</label>
                                            <input type="file" id="evidencia[]" name="evidencia[]" class="form-control" multiple="multiple" size="5120">
                                            <div align="right"><small class="text-muted" style="font-size: 73%;">Tamaño maximo permitido (5MB), si se supera este tamaño, su archivo no será cargado.</small> <span id="cntDescripHechos" align="right"> </span></div>
                                        </div>
                                        <div class="col-sm-3" style="align-self: center;">
                                            <button type="submit" class="btn btn-success">Crear Ticket</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {!!  Form::close() !!}
        </div>
    </div>
</div>
