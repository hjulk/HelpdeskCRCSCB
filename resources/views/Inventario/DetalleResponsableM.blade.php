@extends("theme.$theme.layoutDetalles")
@section('titulo')
Detalle Responsables
@endsection
@section('contenido')
<section class="content-header">
    <div class="row">
        <div class="col-md-8"><h2><i class="fa fa-search"></i>&nbsp;Detalle Responsables Linea {{ $Linea }}</h2></div>
        <div class="col-md-4">
            <button type="button" class="btn btn-default pull-right" onclick="window.close();">Cerrar</button>
            <a href="#" class="btn btn-success pull-right" title="Agregar Responsable" data-toggle="modal" data-target="#modal-agregar-userInv" onclick="obtener_datos_usuarioInv('{{$IdLinea}}');">+ Agregar Responsable</a>
        </div>
    </div>

</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-success">
                    <br>
                <table id="ResponsableMobile" class="display responsive hover" style="width: 100%;">
                    <thead style="background: linear-gradient(60deg,rgba(51,101,155,1),rgba(66,132,206,1));color: #ECF0F1;font-size:12px;text-align: center;">
                        <tr>
                            <th style="text-align: center;">CEDULA</th>
                            <th style="text-align: center;">NOMBRE</th>
                            <th style="text-align: center;">CARGO</th>
                            <th style="text-align: center;">AREA</th>
                            <th style="text-align: center;">SEDE</th>
                            <th style="text-align: center;">CENTRO COSTOS</th>
                            <th style="text-align: center;">ACTUALIZAR</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Responsables as $value)
                            <tr>
                                <td>{{$value['cedula_responsable']}}</td>
                                <td>{{$value['nombre_responsable']}}</td>
                                <td>{{$value['cargo_responsable']}}</td>
                                <td>{{$value['area1_responsable']}}</td>
                                <td>{{$value['sede1_responsable']}}</td>
                                <td>{{$value['centroC_responsable']}}</td>
                                <td style="text-align: center;"><a href="#" class="btn btn-success" title="Actualizar" data-toggle="modal" data-target="#modal-update-responsable" onclick="obtener_update_responsable('{{$value['id']}}');"><i class="fa fa-edit"></i></a></td>
                                <input type="hidden" value="{{$value['id']}}" id="id{{$value['id']}}">
                                <input type="hidden" value="{{$value['id_responsable']}}" id="id_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['nombre_responsable']}}" id="nombre_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['cedula_responsable']}}" id="cedula_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['cargo_responsable']}}" id="cargo_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['area_responsable']}}" id="area_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['sede_responsable']}}" id="sede_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['centroC_responsable']}}" id="centroC_responsable{{$value['id']}}">
                                <input type="hidden" value="{{$value['id_mobile']}}" id="id_mobile{{$value['id']}}">
                                <input type="hidden" value="{{$value['estado']}}" id="estado{{$value['id']}}">
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@include('Modals.ModalAddUserInv')
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
