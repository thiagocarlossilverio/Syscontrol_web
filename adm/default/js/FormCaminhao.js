$(function () {  /*  $.getScript('/adm/default/js/lib/mascaras.js', function () {        $('#placa').mask('aaa9999');    });*/    $('#placa').css({'text-transform': 'uppercase'});    $('#motorista-element').after('<i class="fa fa-plus-square-o fa-6x btincluir incluirMotorista"></i>');    $(document).on("click", ".incluirMotorista", function () {        $.ajax({            url: '/admin/geral/ajax-incluir/param/1',            type: 'GET',            dataType: 'html'        }).done(function (data) {            $('.conteudo').html(data);            $('#myModal').modal('show');        });    });});