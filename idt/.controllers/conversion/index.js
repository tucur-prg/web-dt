$(function () {
    $('textarea[name=value]').keydown(function (ev) {
        if (!ev.shiftKey && ev.keyCode === 13) {
            $('.input-box form').submit();
            return false;
        }

        return true;
    });
});
