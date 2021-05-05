$(function () {
    $(".box-icons i").click(function () {
        $('.box-icons i').attr('id', '');
        $(this).attr('id', 'ativo');
        if ($("#icon-added").length > 0) {
            $("#icon-added").remove();
        }

        $icon = $(this).attr('class');
        $("#icone").val($icon);
        $img = "<i class='" + $icon + "' id='icon-added' style='top:5px; left:10px; position:relative; background:#fff; color:#788288 !important; border-color:#ccc;'></i>";
        $(".icon").html($img);
        $('#myModal').modal('hide');

    });
});

$(document).ready(function () {

    $div = '<div class="icon"></div>';
    $('#action-element').after($div);

    $button = '<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="  margin-bottom: 12px!important;">Selecione um icone</button>';
    $('.icon').after($button);

    $('#permissao').multiselectable({
        selectableLabel: 'Todos os Perfis',
        selectedLabel: 'Perfis Selecionados',
        moveRightText: '+',
        moveLeftText: '-'
    });


});

