@extends("theme.$theme.layoutDetalles")
@section('titulo')
Detalle Novedades
@endsection
@section('contenido')
<section class="content-header">
    <div class="row">
        <div class="col-md-8"><h2><i class="fa fa-search"></i>&nbsp;Detalle Novedades Linea {{ $Linea }}</h2></div>
        <div class="col-md-4">
            <button type="button" class="btn btn-default pull-right" onclick="window.close();">Cerrar</button>
            <a href="#" class="btn btn-primary pull-right" title="Agregar Novedad" data-toggle="modal" data-target="#modal-agregar-novedadMobile" onclick="obtener_datos_novedadMobile('{{$IdLinea}}');">+ Agregar Novedad</a>
        </div>
    </div>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                    <br>
                <table id="NovedadesMobile" class="display responsive hover" style="width: 100%;">
                    <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;font-size:12px;text-align: center;">
                        <tr>
                            <th style="text-align: center;">AÑO</th>
                            <th style="text-align: center;">MES</th>
                            <th style="text-align: center;">VALOR MES</th>
                            <th style="text-align: center;">NOVEDAD MES</th>
                            <th style="text-align: center;">ACTUALIZAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Novedades as $value)
                            <tr>
                                <td>{{$value['yearName']}}</td>
                                <td>{{$value['mesName']}}</td>
                                <td>{{$value['valormes']}}</td>
                                <td>{{$value['novedad_mes']}}</td>
                                <td style="text-align: center;"><a href="#" class="btn btn-success" title="Actualizar" data-toggle="modal" data-target="#modal-update-novedad" onclick="obtener_update_novedad('{{$value['id_novedad']}}');"><i class="fa fa-edit"></i></a></td>
                                <input type="hidden" value="{{$value['id_novedad']}}" id="id{{$value['id_novedad']}}">
                                <input type="hidden" value="{{$value['year']}}" id="year{{$value['id_novedad']}}">
                                <input type="hidden" value="{{$value['mes']}}" id="mes{{$value['id_novedad']}}">
                                <input type="hidden" value="{{$value['valor_mes']}}" id="valor_mes{{$value['id_novedad']}}">
                                <input type="hidden" value="{{$value['novedad_mes']}}" id="novedad_mes{{$value['id_novedad']}}">
                                <input type="hidden" value="{{$value['linea']}}" id="NroLinea{{$value['id_novedad']}}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@include('Modals.ModalUpdatesMobile')
@include('Modals.ModalNovedadMobile')
@section('scripts')
    <script src="{{asset("assets/$theme/dist/js/inventario.js")}}"></script>
    <script>
        @if (session("mensaje"))
            toastr.success("{{ session("mensaje") }}");
        @endif

        @if (session("precaucion"))
            toastr.warning("{{ session("precaucion") }}");
        @endif

        @if (count($errors) > 0)
            @foreach($errors -> all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
@endsection
