var escuela_ccts = function () {
    var table = null;
    var obj = null;

    var configurarDataTable = function () {
        table = $('table#escuela_ccts_entity_table').DataTable({
            "pagingType": "simple_numbers",
            "language": {
                url: datatable_url
            },
            columns: [
                {data: 'value'},
                {data: 'acciones'}
            ]
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
        $('div#basicmodal').on('submit', 'form#escuela_ccts_new', function (evento) {
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
                    }else {
                        if (data['mensaje'])
                            toastr.success(data['mensaje']);

                        $('div#basicmodal').modal('hide');
                        var pagina = table.page();
                        objeto = table.row.add({
                            "value": data['value'],
                            "acciones": "<ul class='hidden_element list-inline pull-right'>" +
                                "<li class='list-inline-item'>" +
                                "<a class='font-weight-bold text-uppercase edicion' data-href=" + Routing.generate('escuela_ccts_edit', {id: data['id']}) + ">Editar</a></li>" +
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
        $('div#basicmodal').on('submit', 'form#escuela_ccts_edit', function (evento) {
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
                    } else{
                        $('div#basicmodal').modal('hide');
                        var pagina = table.page();
                        obj.parents('tr').children('td:nth-child(1)').html(data['value']);
                    }

                },
                error: function () {
                    //base.Error();
                }
            });
        });
    }

    var eliminar = function () {
        $('div#basicmodal').on('click', 'a.eliminar_escuela_ccts', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            var token = $(this).attr('data-csrf');
            $('div#basicmodal').modal('hide');

            bootbox.confirm({
                title: 'Eliminar ccts',
                message: '¿Está seguro que desea eliminar este ccts?',
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