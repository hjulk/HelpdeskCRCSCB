<?php

return array(
    "accepted" => ":attribute debe ser aceptado.",
    "active_url" => ":attribute no es una URL valida.",
    "after" => ":attribute debe contener una fecha despues :date.",
    "alpha" => ":attribute solo debe contener caracteres.",
    "alpha_dash" => ":attribute solo puede contener letras, numeros y guiones.",
    "alpha_num" => ":attribute solo puede contener letras y numeros.",
    "array" => ":attribute debe ser un array.",
    "before" => ":attribute debe ser una fecha antes a :date.",
    "between" => array(
        "numeric" => ":attribute debe tener entre :min y :max.",
        "file" => ":attribute debe tener entre :min y :max kilobytes.",
        "string" => ":attribute debe tener entre :min y :max caracteres.",
        "array" => ":attribute debe tener entre :min y :max items.",
    ),
    "confirmed" => ":attribute de confirmaci&oacute;n no coincide.",
    "date" => ":attribute no es una fecha valida.",
    "date_format" => ":attribute does not match the format :format.",
    "different" => ":attribute and :other must be different.",
    "digits" => ":attribute debe ser :digits digitos.",
    "digits_between" => ":attribute debe estar entre :min y :max digitos.",
    "email" => ":attribute formato invalido.",
    "exists" => "seleccione :attribute es invalido.",
    "image" => ":attribute debe ser una imagen.",
    "in" => ":attribute es invalido.",
    "integer" => ":attribute debe ser un numerico.",
    "ip" => ":attribute must be a valid IP address.",
    "max" => array(
        "numeric" => ":attribute no debe ser mayor a :max.",
        "file" => ":attribute no debe ser mayor a :max kilobytes.",
        "string" => ":attribute no debe ser mayor a :max caracteres.",
        "array" => ":attribute no debe ser mayor a :max items.",
    ),
    "mimes" => ":attribute debe ser de tipo: :values.",
    "min" => array(
        "numeric" => ":attribute debe contener minimo :min.",
        "file" => ":attribute debe contener minimo :min kilobytes.",
        "string" => ":attribute debe contener minimo :min caracteres.",
        "array" => ":attribute debe contener minimo :min items.",
    ),
    "not_in" => ":attribute seleccionado es invalido.",
    "numeric" => ":attribute debe ser numerico.",
    "regex" => "formato :attribute no cumple con las condiciones definidas.",
    "required" => ":attribute es requerido.",
    "required_if" => ":attribute field is required when :other is :value.",
    "required_with" => ":attribute field is required when :values is present.",
    "required_without" => ":attribute field is required when :values is not present.",
    "same" => ":attribute and :other must match.",
    "size" => array(
        "numeric" => ":attribute must be :size.",
        "file" => ":attribute must be :size kilobytes.",
        "string" => ":attribute must be :size characters.",
        "array" => ":attribute must contain :size items.",
    ),
    "unique" => ":attribute ya se encuentra registrado.",
    "url" => ":attribute format is invalid.",
    "recaptcha" => ':attribute no se digito correctamente.',
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | Here you may specify custom validation messages for attributes using the
      | convention "attribute.rule" to name the lines. This makes it quick to
      | specify a specific custom language line for a given attribute rule.
      |
     */
    'custom' => array(),
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Attributes
      |--------------------------------------------------------------------------
      |
      | The following language lines are used to swap attribute place-holders
      | with something more reader friendly such as E-Mail Address instead
      | of "email". This simply helps us make messages a little cleaner.
      |
     */
    'attributes' => array(


        'user'                  =>  'Usuario',
        'password'              =>  'Contraseña',
        'g-recaptcha-response'  =>  'Validador ReCaptcha',
        'zona'                  =>  'Nombre Zona',
        'sede'                  =>  'Nombre Sede',
        'area'                  =>  'Nombre Area',
        'id_area'               =>  'Area',
        'tipoZona'              =>  'Zona',
        'tipoZonaArea'          =>  'Zona',
        'tipoSede'              =>  'Sede',
        'direccionSede'         =>  'Direccion de la Sede',
        'nombre_usuario'        =>  'Nombre completo de Usuario',
        'username'              =>  'Nombre de usuario login',
        'email'                 =>  'Correo electrónico',
        'id_rol'                =>  'Rol',
        'id_categoria'          =>  'Categoria',
        'id_activo'             =>  'Estado Activo o Inactivo',
        'id_zona'               =>  'Zona',
        'id_zona1'              =>  'Zona',
        'id_sede'               =>  'Sede',
        'tipoZonaArea1'         =>  'Zona',
        'rol'                   =>  'Nombre Rol',
        'categoria'             =>  'Nombre Categoria',
        'asunto'                =>  'Asunto del ticket',
        'descripcion'           =>  'Descripción de la solicitud',
        'descripcion_ticket'    =>  'Descripción de la apertura',
        'telefono_usuario'      =>  'Telefono(s) del usuario',
        'correo_usuario'        =>  'Correo(s) del usuario',
        'id_tipo'               =>  'Tipo de solicitud',
        'id_prioridad'          =>  'Prioridad de la Solicitud',
        'id_estado'             =>  'Estado del Ticket',
        'id_categoria'          =>  'Categoria TICS a asignar solicitud',
        'id_usuario'            =>  'Usuario a asignar',
        'id_tipoT'              =>  'Tipo de solicitud',
        'id_prioridadT'         =>  'Prioridad de la Solicitud',
        'id_estadoT'            =>  'Estado del Ticket',
        'id_categoriaT'         =>  'Categoria TICS a asignar solicitud',
        'id_usuarioT'           =>  'Usuario a asignar',
        'nombre_usuario_upd'    =>  'Nombre completo de Usuario',
        'telefono_usuario_upd'  =>  'Telefono(s) del usuario',
        'correo_usuario_upd'    =>  'Correo(s) del usuario',
        'id_prioridad_upd'      =>  'Prioridad de la Solicitud',
        'id_categoriaupd'       =>  'Categoria TICS a reasignar solicitud',
        'id_usuarioupd'         =>  'Usuario a reasignar',
        'id_estado_upd'         =>  'Estado del Ticket',
        'comentario'            =>  'Comentario sobre el ticket',
        'fechaFin'              =>  'Fecha Fin',
        'fechaInicio'           =>  'Fecha Inicio',
        'id_ticket'             =>  'Numero de Ticket',
        'id_impacto'            =>  'Nivel de Impacto',
        'id_plataforma'         =>  'Nombre Plataforma',
        'id_ambiente'           =>  'Tipo de Ambiente',
        'nombre_solicitante'    =>  'Nombre completo del Solicitante',
        'correo_solicitante'    =>  'Telefono(s) del usuario',
        'telefono_solicitante'  =>  'Correo(s) del usuario',
        'id_categoriaC'         =>  'Categoria TICS a asignar solicitud',
        'id_usuarioC'           =>  'Usuario a asignar',
        'id_categoriaCUPD'      =>  'Categoria TICS a asignar solicitud',
        'id_usuarioCUPD'        =>  'Usuario a asignar',
        'comentarioC'           =>  'Comentario sobre la solicitud',
        'id_solicitud'          =>  'No. de solicitud de control de cambios',
        'id_categoriaCC'        =>  'Categoria TICS a asignar solicitud',
        'id_usuarioCC'          =>  'Usuario a asignar',
        'id_impactoCC'          =>  'Nivel de Impacto',
        'id_estadoCC'           =>  'Estado del Ticket',
        'descripcion_solicitudCC' =>  'Descripción de la apertura',
        'yearNovedad'           => 'Año Novedad',
        'mesNovedad'            => 'Mes Novedad',
        'valor_mes'             => 'Valor del Mes',
        'novedad'               => 'Novedad'
    ),
);
