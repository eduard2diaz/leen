var plantel_escuela = function () {
    var table = null;
    var obj = null;

    var configurarDataTable = function () {
        table = $('table#escuela_entity_table').DataTable({
            "pagingType": "simple_numbers",
            "language": {
                url: datatable_url,
                "sEmptyTable":     "No hay escuelas que listar",
            },
            columns: [
                {data: 'id'},
                {data: 'ccts'},
                {data: 'nombre'},
                {data: 'acciones'}
            ]
        });
    }

    var configurarFormulario = function () {
        $('select#escuela_tipoensenanza').select2({
            dropdownParent: $("#basicmodal"),
            placeholder: "Seleccione al menos un tipo de enseanza"
        });

        $("body div#basicmodal form[name='escuela']").validate({
            rules: {
                'escuela[ccts]': {required: true},
                'escuela[nombre]': {required: true},
                'escuela[tipoensenanza][]': {required: true},
            }
        });
    }

    var edicion = function () {
        $('body').on('click', 'a.edicion', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            obj = $(this);
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: link,
                beforeSend: function (data) {
                    $.blockUI({message: '<small>Cargando...</small>'});
                },
                success: function (data) {
                    if ($('div#basicmodal').html(data)) {
                        configurarFormulario();
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

    var newAction = function () {
        $('div#basicmodal').on('submit', 'form#escuela_new', function (evento) {
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
                    }else {
                        if (data['mensaje'])
                            toastr.success(data['mensaje']);

                        $('div#basicmodal').modal('hide');
                        var pagina = table.page();
                        escuelaCounter++;
                        objeto = table.row.add({
                            "id": escuelaCounter,
                            "ccts": data['ccts'],
                            "nombre": data['nombre'],
                            "acciones": "<ul class='hidden_element list-inline pull-right'>" +
                                "<li class='list-inline-item'>" +
                                "<a class='btn btn-sm' href=" + Routing.generate('escuela_show', {id: data['id']}) + "><i class='fa fa-eye'></i>Visualizar</a></li>" +
                                "<li class='list-inline-item'>" +
                                "<a class='btn btn-primary btn-sm edicion' data-href=" + Routing.generate('escuela_edit', {id: data['id']}) + "><i class='fa fa-edit'></i>Editar</a></li>" +
                                "</ul>",
                        });
                        objeto.draw();
                        table.page(pagina).draw('page');
                    }
                },
                error: function () {
                    //base.Error();
                }
            });
        });
    }

    var edicionAction = function () {
        $('div#basicmodal').on('submit', 'form#escuela_edit', function (evento) {
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
                    } else{
                        $('div#basicmodal').modal('hide');
                        var pagina = table.page();
                        obj.parents('tr').children('td:nth-child(2)').html(data['ccts']);
                        obj.parents('tr').children('td:nth-child(3)').html(data['nombre']);
                    }

                },
                error: function () {
                    //base.Error();
                }
            });
        });
    }

    var eliminar = function () {
        $('div#basicmodal').on('click', 'a.eliminar_escuela', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            var token = $(this).attr('data-csrf');
            $('div#basicmodal').modal('hide');

            bootbox.confirm({
                title: 'Eliminar escuela',
                message: '¿Está seguro que desea eliminar este escuela?',
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
                                $.blockUI({message: '<h1><img src="busy.gif" /> Just a moment...</h1>'});
                            },
                            complete: function () {
                                $.unblockUI();
                            },
                            success: function (data) {
                                table.row(obj.parents('tr'))
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
                    configurarDataTable();
                    newAction();
                    edicionAction();
                    edicion();
                    eliminar();
                }
            );
        }
    }
}();
