var condicion_docente_educativa = function () {
    var tableCondicionDocente = null;
    var objCondicionDocente = null;

    var configurarDataTableCDE = function () {
        tableCondicionDocente = $('table#condicion_docente_educativa_entity_table').DataTable({
            "pagingType": "simple_numbers",
            "language": {
                url: datatable_url
            },
            columns: [
                {data: 'numero'},
                {data: 'ccts'},
                {data: 'curp'},
                {data: 'nombre'},
                {data: 'grado'},
                {data: 'acciones'}
            ]
        });
    }

    var edicionCDE = function () {
        $('body').on('click', 'a.edicion_condicion_docente_educativa', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            objetoCondicionDocente = $(this);
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: link,
                beforeSend: function (data) {
                    $.blockUI({ message: '<small>Cargando...</small>' });
                },
                success: function (data) {
                    if ($('div#basicmodal').html(data)) {
                        $('div#basicmodal').modal('show');
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


    var newCDEAction = function () {

        $('div#basicmodal').on('submit', 'form#condicion_docente_educativa_new', function (evento) {
            evento.preventDefault();
            var padre = $(this).parent();
            var l = Ladda.create(document.querySelector('.ladda-button'));
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: $(this).serialize(),
                beforeSend: function () {
                 //   l.start();
                },
                complete: function () {
                  //  l.stop();
                },
                success: function (data) {
                    if (data['error']) {
                        padre.html(data['form']);
                    } else {
                        if (data['mensaje'])
                            toastr.success(data['mensaje']);

                        $('div#basicmodal').modal('hide');
                        var pagina = tableCondicionDocente.page();
                        condicion_docente_educativaCounter++;
                        objetoCondicionDocente = tableCondicionDocente.row.add({
                            "numero": condicion_docente_educativaCounter,
                            "ccts": data['ccts'],
                            "curp": data['curp'],
                            "nombre": data['nombre'],
                            "grado": data['grado'],
                            "acciones": "<ul class='hidden_element list-inline pull-right'>" +
                                "<li class='list-inline-item'>" +
                                "<a class='btn btn-primary btn-sm edicion_condicion_docente_educativa' data-href=" + Routing.generate('condicion_docente_educativa_edit', {id: data['id']}) + "><i class='fa fa-edit'></i>Editar</a></li>" +
                                "</ul>",
                        });
                        objetoCondicionDocente.draw();
                        tableCondicionDocente.page(pagina).draw('page');
                    }
                },
                error: function () {
                    //base.Error();
                }
            });

        });
    }

    var edicionCDEAction = function () {
        $('div#basicmodal').on('submit', 'form#condicion_docente_educativa_edit', function (evento) {
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
                    if (data['error']){
                        padre.html(data['form']);
                    }
                    else {
                        if (data['mensaje'])
                            toastr.success(data['mensaje']);

                        $('div#basicmodal').modal('hide');
                        var pagina = tableCondicionDocente.page();
                        objetoCondicionDocente.parents('tr').children('td:nth-child(2)').html(data['ccts']);
                        objetoCondicionDocente.parents('tr').children('td:nth-child(3)').html(data['curp']);
                        objetoCondicionDocente.parents('tr').children('td:nth-child(4)').html(data['nombre']);
                        objetoCondicionDocente.parents('tr').children('td:nth-child(5)').html(data['grado']);
                    }
                },
                error: function () {
                    //base.Error();
                }
            });
        });
    }

    var eliminarCDE = function () {
        $('div#basicmodal').on('click', 'a.eliminar_condicion_docente_educativa', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            var token = $(this).attr('data-csrf');
            $('div#basicmodal').modal('hide');

            bootbox.confirm({
                title: 'Eliminar condición docente educativa',
                message: '¿Está seguro que desea eliminar esta condición docente educativa?',
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
                                tableCondicionDocente.row(objetoCondicionDocente.parents('tr'))
                                    .remove()
                                    .draw('page');
                                toastr.success(data['mensaje']);
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
        init: function () {
            $().ready(function () {
                    configurarDataTableCDE();
                    edicionCDE();
                    newCDEAction();

                    edicionCDEAction();
                    eliminarCDE();
                }
            );
        }
    }
}();