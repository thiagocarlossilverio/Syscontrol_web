$(function () {
    CKEDITOR.replace('resposta');
      
    if ($('#resposta').val() !=='') {
        $('#resposta').attr('disabled', 'disabled');
    }
});

