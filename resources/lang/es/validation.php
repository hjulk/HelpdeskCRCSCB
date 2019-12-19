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
        'nombre_usuario'        =>  'Nombre completo de Usuario',
        'username'              =>  'Nombre de usuario login',
        'email'                 =>  'Correo electrónico',
        'kind_id'               =>  'tipo de ticket',
        'title'                 =>  'Asunto',
        'description'           =>  'Descripción',
        'telefono_usuario'      =>  'Telefóno de Usuario',
        'correo_usuario'        =>  'Correo electrónico del usuario',
        'project_id'            =>  'Sede',
        'dependencia'           =>  'Area o Dependencia',
        'priority_id'           =>  'Prioridad',
        'id_prioridad_upd'      =>  'Prioridad',
        'id_categoria'          =>  'Categoria TICS',
        'id_categoriaupd'       =>  'Categoria TICS',
        'id_usuario'            =>  'Responsable',
        'id_usuarioupd'         =>  'Responsable',
        'id_estado'             =>  'Estado',
        'id_estadoupd'          =>  'Estado',
        'comentario'            =>  'Comentario / Observación del Ticket',
        'evidencia'             =>  'Evidencia',
        'fechaInicio'           =>  'Fecha Inicio',
        'fechaFin'              =>  'Fecha Final',
        'nombres'               =>  'Nombres y Apellidos',
        'identificacion'        =>  'Identificación',
        'cargo'                 =>  'Cargo de Usuario',
        'sede'                  =>  'Sede',
        'area'                  =>  'Area o Dependencia',
        'jefe'                  =>  'Nombre del Jefe',
        'fechaIngreso'          =>  'Fecha Ingreso',
        'correoS'               =>  'Correo electrónico del usuario',
        'cargo_nuevo'           =>  'Cargo Nuevo',
        'estado'                =>  'Estado',
        'prioridad'             =>  'Prioridad',
        'tipo_equipo'           =>  'Tipo de Equipo',
        'fecha_adquision'       =>  'Fecha de Adquisición',
        'Serial'                =>  'Serial',
        'linea_movil'           =>  'Numero de Linea Movil',
        'nombre_asignado'       =>  'Nombre del Asignado / Responsable'
    ),
);
