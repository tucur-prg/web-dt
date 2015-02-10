SyntaxHighlighter.all();

$(function () {
    target = 'html';

    $('input[name=tabs]').change(function() {
        tab = $(this).attr('id');

        $('.tab').hide();
        $('.'+tab).show();
    });

    $('#'+target).click();
});
