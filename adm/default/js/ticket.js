$(function () {    var id = $('.param').data('id');    $('.nav-tabs').html('<button id="btnPrint"  type="button" class="btn btn-default btn-lg"><i class="fa fa-print"></i> Imprimir</button>');    $("#btnPrint").live("click", function () {        window.open("/admin/cargas/ticket/id/" + id, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=50,left=300,width=950,height=600");    });});