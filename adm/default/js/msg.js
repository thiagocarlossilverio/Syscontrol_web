/*Oculta a Mensagem de alerta*/
$(document).ready(function() {
/**Faz  o efeito a exibi a mensagem*/ 
$("#alerta").fadeIn(900);

/*Oculta a  mensagem*/
setTimeout("$('#alerta').fadeOut('slow')", 4000);
});

