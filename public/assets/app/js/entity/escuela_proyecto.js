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
                {data: 'escuela'},
                {data: 'finicio'},
                {data: 'acciones'}
            ]
        });
    }


    var show = function () {
        $('body').on('click', 'a.show', function (evento) {
            evento.preventDefault();
            var link = $(this).attr('data-href');
            obj = $(this);
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



    return {
        init: function () {
            $().ready(function () {
                    configurarDataTable();
                    show();
                }
            );
        }
    }
}();