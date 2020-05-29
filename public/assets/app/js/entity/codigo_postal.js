var codigo_postal = function () {

    var configurarFormulario = function () {
        $('select#codigo_postal_tipoasentamiento').select2({
            placeholder: "Seleccione un tipo de asentamiento"
        });
        $('select#codigo_postal_estado').select2({
            placeholder: "Seleccione un estado"
        });
        $('select#codigo_postal_municipio').select2({
            placeholder: "Seleccione un municipio"
        });
        $('select#codigo_postal_ciudad').select2({
            placeholder: "Seleccione una ciudad"
        });
        $('select#codigo_postal_d_zona').select2({
            placeholder: "Seleccione un código postal"
        });
    }

    var addEditAction = function () {
        $('body').on('submit', 'form#codigo_postal_form', function (evento) {
            evento.preventDefault();
            var padre = $(this).parent();
            var l = Ladda.create(document.querySelector('.ladda-button'));
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                    l.start();
                },
                complete: function () {
                    l.stop();
                },
                success: function (data) {
                    if (data['error']) {
                        padre.html(data['form']);
                        configurarFormulario();
                    } else
                        document.location.href=data['url'];
                },
                error: function () {
                    //base.Error();
                }
            });
        });
    }

    var show = function () {
        $('body').on('click', 'a.showCp', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: link,
                beforeSend: function (data) {
                    $.blockUI({ message: '<small>Cargando...</small>' });
                },
                success: function (data) {
                    if ($('div#basicmodal').html(data))
                        $('div#basicmodal').modal('show');
                },
                error: function () {
                    //base.Error();
                },
                complete: function () {
                    $.unblockUI();
                }
            });
        });
    }

    var eliminar = function () {
        $('body').on('click', 'a.eliminar_codigo_postal', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            var token = $(this).attr('data-csrf');

            bootbox.confirm({
                title: 'Eliminar código postal',
                message: '¿Está seguro que desea eliminar este código postal?',
                buttons: {
                    confirm: {
                        label: 'Si, estoy seguro',
                        className: 'btn-sm btn-primary'
                    },
                    cancel: {
                        label: 'Cancelar',
                        className: 'btn-sm btn-secondary'
                    }
                },
                callback: function (result) {
                    if (result == true)
                        $.ajax({
                            type: 'get',
                            url: link,
                            data: {
                                _token: token
                            },
                            beforeSend: function () {
                                $.blockUI({ message: '<h1><img src="busy.gif" /> Just a moment...</h1>' });
                            },
                            complete: function () {
                                $.unblockUI();
                            },
                            success: function (data) {
                                document.location.href=data['url'];
                            },
                            error: function () {
                                //base.Error();
                            }
                        });
                }
            });
        });
    }

    var estadoListener = function () {
        $('body').on('change', 'select#codigo_postal_estado', function (evento)
        {
            if ($(this).val() > 0)
                $.ajax({
                    type: 'get', //Se uso get pues segun los desarrolladores de yahoo es una mejoria en el rendimineto de las peticiones ajax
                    dataType: 'json',
                    url: Routing.generate('municipio_find_by_estado', {'id': $(this).val()}),
                    beforeSend: function (data) {
                        $.blockUI({message: '<small>Cargando...</small>'});
                    },
                    success: function (data) {
                        var cadena="";
                        var array=JSON.parse(data);
                        if(data!=null) {
                            for (var i = 0; i < array.length; i++)
                                cadena += "<option value=" + array[i]['id'] + ">" + array[i]['nombre'] + "</option>";
                            $('select#codigo_postal_municipio').html(cadena);
                            $('select#codigo_postal_municipio').change();
                        }
                        else{
                            $('select#codigo_postal_municipio').html(cadena);
                            $('select#codigo_postal_ciudad').html(cadena);
                        }
                    },
                    error: function () {
                        //base.Error();
                    },
                    complete: function () {
                        $.unblockUI();
                    }
                });
        });
    }

    var municipioListener = function () {
        $('body').on('change', 'select#codigo_postal_municipio', function (evento)
        {
            if ($(this).val() > 0)
                $.ajax({
                    type: 'get', //Se uso get pues segun los desarrolladores de yahoo es una mejoria en el rendimineto de las peticiones ajax
                    dataType: 'json',
                    url: Routing.generate('ciudad_find_by_municipio', {'id': $(this).val()}),
                    beforeSend: function (data) {
                        $.blockUI({message: '<small>Cargando...</small>'});
                    },
                    success: function (data) {
                        var cadena="";
                        var array=JSON.parse(data);
                        if(data!=null) {
                            for (var i = 0; i < array.length; i++)
                                cadena += "<option value=" + array[i]['id'] + ">" + array[i]['nombre'] + "</option>";
                        }
                        $('select#codigo_postal_ciudad').html(cadena);
                    },
                    error: function () {
                        //base.Error();
                    },
                    complete: function () {
                        $.unblockUI();
                    }
                });
        });
    }


    return {
        index: function () {
            $().ready(function () {
                    show();

                }
            );
        },
        addEdit: function () {
            $().ready(function () {
                addEditAction();
                eliminar();
                estadoListener();
                municipioListener();
                configurarFormulario();
                }
            );
        }
    }
}();