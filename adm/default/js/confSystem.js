$(function () {

    var cor1 = $('#picker1').val();

    $('#picker1').css({"border-right-color": '#' + cor1, "color": '#' + cor1});

    $('#picker1').colpick({
        layout: 'hex',
        submit: 0,
        colorScheme: 'dark',
        color: 'ff8800',
        onChange: function (hsb, hex, rgb, el, bySetColor) {
            $(el).css('border-color', '#' + hex);
            // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
            if (!bySetColor)
                $(el).val(hex);
        }
    }).keyup(function () {
        $(this).colpickSetColor(this.value);
    });

    var cor2 = $('#picker2').val();

    $('#picker2').css({"border-right-color": '#' + cor2, "color": '#' + cor2});

    $('#picker2').colpick({
        layout: 'hex',
        submit: 0,
        colorScheme: 'dark',
        color: 'ff8800',
        onChange: function (hsb, hex, rgb, el, bySetColor) {
            $(el).css('border-color', '#' + hex);
            // Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
            if (!bySetColor)
                $(el).val(hex);
        }
    }).keyup(function () {
        $(this).colpickSetColor(this.value);
    });


});