$(document).ready(function () {    $.getScript('/adm/default/js/lib/mascaras.js', function () {        $(".data").mask("99/99/9999");        $(".data").datepicker({            dateFormat: "dd/mm/yy",            dayNamesMin: ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"],            monthNames: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"]});    });    $(".btnPrint").live("click", function () {        var id = $(this).data('id');        var percentual = $(this).data('percentual');        if (percentual != '') {            $("#mensagem").html("<p>A porcentagem de indice de quebra, está acima de 0.2%</p>");            $("#mensagem").dialog({                modal: true,                buttons: {                    Ok: function () {                        $(this).dialog("close");                        window.open("/admin/cargas/ticket/id/" + id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=300,width=950,height=600");                    }                }            });            $("#mensagem").dialog("open");        } else {            window.open("/admin/cargas/ticket/id/" + id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=300,width=950,height=600");        }    });    $("#categoria").change("click", function () {        var categoria = $('#categoria option:selected').val();        var data_inicio = $('#data_inicio').val();        var data_fim = $('#data_fim').val();        if (categoria !== '') {            var param_categoria = '/categoria/' + categoria;        } else {            var param_categoria = '';        }        if (data_inicio == '' || data_inicio == 'undefined') {            alerta("Insira a data inicial!");            return false;        }        if (data_fim == '' || data_fim == 'undefined') {            alerta("Insira a data final!");            return false;        }        if (VerificaData(data_fim) < VerificaData(data_inicio)) {            $('#data_fim').val('');            alerta("Atenção a data final não pode ser menor que a data inicial!");            return false;        }        if (data_inicio !== '') {            var param_data_inicio = '/inicio/' + ConverteData(data_inicio);        } else {            var param_data_inicio = '';        }        if (data_fim !== '') {            var param_data_data_fim = '/fim/' + ConverteData(data_fim);        } else {            var param_data_data_fim = '';        }        window.location = '/admin/relatorios/cargas' + param_categoria + param_data_inicio + param_data_data_fim;    });    $('#pesquisar').click(function () {        var categoria = $('#categoria option:selected').val();        var data_inicio = $('#data_inicio').val();        var data_fim = $('#data_fim').val();        if (categoria !== '') {            var param_categoria = '/categoria/' + categoria;        } else {            var param_categoria = '';        }        if (data_inicio == '' || data_inicio == 'undefined') {            alerta("Insira a data inicial!");            return false;        }        if (data_fim == '' || data_fim == 'undefined') {            alerta("Insira a data final!");            return false;        }        if (VerificaData(data_fim) < VerificaData(data_inicio)) {            $('#data_fim').val('');            alerta("Atenção a data final não pode ser menor que a data inicial!");            return false;        }        if (data_inicio !== '') {            var param_data_inicio = '/inicio/' + ConverteData(data_inicio);        } else {            var param_data_inicio = '';        }        if (data_fim !== '') {            var param_data_data_fim = '/fim/' + ConverteData(data_fim);        } else {            var param_data_data_fim = '';        }        window.location = '/admin/relatorios/cargas' + param_categoria + param_data_inicio + param_data_data_fim;    });});function VerificaData(str) {    var partes = str.split("/");    return new Date(partes[2], partes[1] - 1, partes[0]);}function ConverteData(date) {    return date.split('/').reverse().join('-');}function alerta(msg) {    $("#mensagem").html("<p>" + msg + "</p>");    $("#mensagem").dialog({        modal: true,        buttons: {            Ok: function () {                $(this).dialog("close");            }        }    });    $("#mensagem").dialog("open");}function loadPageVar(sVar) {    return decodeURI(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURI(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));}