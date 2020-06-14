var escuela_proyecto = function () {
    var table = null;
    var obj = null;

    var configurarDataTable = function () {
        table = $('table#proyecto_entity_table').DataTable({
            "pagingType": "simple_numbers",
            "language": {
                url: datatable_url
            },
            columns: [
                {data: 'id'},
                {data: 'numero'},
                {data: 'fechainicio'},
                {data: 'estatus'},
                {data: 'acciones'}
            ]
        });
    }

    var configurarFormulario = function () {
        $('select#proyecto_escuela').select2({
            dropdownParent: $("#basicmodal"),
        });
        $('input#proyecto_fechainicio').datepicker();
        $('input#proyecto_fechafin').datepicker();
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
                        configurarFormulario();
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
        $('div#basicmodal').on('submit', 'form#proyecto_new', function (evento) {
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
                        proyectoCounter++;
                        objeto = table.row.add({
                            "id": proyectoCounter,
                            "numero": data['numero'],
                            "fechainicio": data['fechainicio'],
                            "estatus": data['estatus'],
                            "acciones": "<ul class='hidden_element list-inline pull-right'>" +
                                "<li class='list-inline-item'>" +
                                "<a class='btn btn-sm show-proyecto' data-href=" + Routing.generate('proyecto_show', {id: data['id']}) + "><i class='fa fa-eye'></i>Visualizar</a></li>" +
                                "<li class='list-inline-item'>" +
                                "<a class='btn btn-primary btn-sm edicion' data-href=" + Routing.generate('proyecto_edit', {id: data['id']}) + "><i class='fa fa-edit'></i>Editar</a></li>" +
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
        $('div#basicmodal').on('submit', 'form#proyecto_edit', function (evento) {
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
                        obj.parents('tr').children('td:nth-child(2)').html(data['numero']);
                        obj.parents('tr').children('td:nth-child(3)').html(data['fechainicio']);
                        obj.parents('tr').children('td:nth-child(4)').html(data['estatus']);
                    }

                },
                error: function () {
                    //base.Error();
                }
            });
        });
    }

    var eliminar = function () {
        $('div#basicmodal').on('click', 'a.eliminar_proyecto', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            var token = $(this).attr('data-csrf');
            $('div#basicmodal').modal('hide');

            bootbox.confirm({
                title: 'Eliminar proyecto',
                message: '¿Está seguro que desea eliminar este proyecto?',
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
                                document.location.href = data['url'];
                            },
                            error: function () {
                                //base.Error();
                            }
                        });
                }
            });
        });
    }

    var show = function () {
        $('body').on('click', 'a.show-proyecto', function (evento) {
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


    return {
        init: function () {
            $().ready(function () {
                    configurarDataTable();
                    newAction();
                    edicionAction();
                    edicion();
                    show();
                    eliminar();
                }
            );
        }
    }
}();