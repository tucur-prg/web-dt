$(function () {
    $('textarea[name=query]').keydown(function (ev) {
        if (ev.shiftKey && ev.keyCode === 13) {
            $('.input-box form:first').submit();
            return false;
        }

        return true;
    });

    $('input[name=tab]').click(function () {
        $('section.result').hide();
        $('[jq-tab-bind="'+$(this).val()+'"]').show();
    });

    $('input[name=tab]:first').click();
});
