function bootstrapCollectionBorrarItem(item) {
    $(item).parent().parent().remove();
}

function inicializarFecha() {
//Date picker
    $('.datepicker').datepicker({
        format: "dd/mm/yyyy",
        language: twigLocale,
        autoclose: true
    });
    //Date range picker
    $('.daterange').daterangepicker({
        format: 'DD/MM/YYYY',
        "locale": {
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa",
                "Do"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Deciembre"
            ],
            "firstDay": 1
        },
    });
    //Timepicker
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false,
        defaultTime: false
    });

    $(".select2").select2({
        language: twigLocale,
        "language": {
            "noResults": function () {
                return "No se encontraron resultados";
            }
        },
    });
}

function modalAlert(msg) {
    $('#modal-alert .modal-body').html(msg);
    $('#modal-alert').modal('toggle');
}

/**
 * Abre un modal para confirmar
 *
 * @param titulo
 * @param body
 * @param okButonHref
 */
function modalConfirm(titulo, body, okButonHref) {
    $('#modal-alert .modal-body').html(body);
    $('#modal-alert #myModalLabel').html(titulo);
    $('#modal-alert #modal-btn-ok').attr('href', okButonHref);
    $('#modal-alert').modal('toggle');
}

/**
 * Funcion para limpiar los campos de un form
 *
 * @param form el formulario a limpiar
 */
function resetFormulario(form) {

    form.find('input, textarea, input:not([type="submit"])').removeAttr('value');
    form.find('input, textarea, input:not([type="submit"])').val('');
    form.find('input:radio, input:checkbox').removeAttr('checked').removeAttr('selected');

    form.find('select option').removeAttr('selected').find('option:first').attr('selected', 'selected');

}

$(document).ready(function () {

    $(document).ajaxStart(function () {
        $.blockUI(
            {
                message: '<div class="progress progress-striped active"><div class="progress-bar" style="width: 100%"></div></div>',
                css: {backgroundColor: 'none', border: 'none'},
                baseZ: 1050,
            }
        )
    });
    $(document).ajaxStop($.unblockUI);


    if (typeof twigLocale === 'undefined') {
        twigLocale = 'es';
    }

    switch (twigLocale) {
        case 'pt':
            dataTableLang = {
                "search": "Pesquisar:",
                "zeroRecords": "Sem resultados"
            };
            break;
        case 'en':
            dataTableLang = {
                "search": "Search:",
                "zeroRecords": "No Result"
            };
            break;
        default:
            dataTableLang = {
                "search": "Buscar:",
                "zeroRecords": "Sin resultados"
            };
            break;
    }


    inicializarFecha();

    $(".data-table").DataTable({
        "paging": false,
        "autoWidth": true,
        "info": false,
        "scrollX": true,
        "order": [],
        "language": dataTableLang
    });

    //iCheck for checkbox and radio inputs
    //$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    //    checkboxClass: 'icheckbox_minimal-blue',
    //    radioClass: 'iradio_minimal-blue'
    //});

    $("button:reset").click(function () {
        resetFormulario($(this).parents('form'));
    })
});