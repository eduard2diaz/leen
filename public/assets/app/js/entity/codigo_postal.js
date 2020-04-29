var codigo_postal = function () {

    var configurarFormulario = function () {
        $('select#codigo_postal_tipoasentamiento').select2();
        $('select#codigo_postal_estado').select2();
        $('select#codigo_postal_municipio').select2();
        $('select#codigo_postal_ciudad').select2();
        $('select#codigo_postal_d_zona').select2();
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
                configurarFormulario();
                }
            );
        }
    }
}();