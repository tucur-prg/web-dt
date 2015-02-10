header = [];
post   = [];
cookie = [];

function modifyField(target, type, key, value)
{
    var hashId = 'line-'+type+'-'+key;

    if (type == '' || key == '') {
        return false;
    }
    if ($('#'+hashId).length > 0) {
        return false;
    }

    var html = '<div class="param on" id="'+hashId+'">'
             +     '<span class="key">'+key+'</span>'
             +     '<span class="value"><input type="text" name="'+type+'::'+key+'" value="'+value+'" size="50"></span>'
             + '</div>';

    $('.'+type).append(html);

    $('<span>').addClass('type')
               .click(function () {
                   $(this).parent().toggleClass('on');
                   $(this).parent().toggleClass('off');
               })
               .prependTo('#'+hashId);

    $('<span>').addClass('button')
               .addClass('btn-remove')
               .click(function () {
                   $(this).parent().remove();
               })
               .html('×')
               .appendTo('#'+hashId);
}

$(function () {
    $.each(header, function (index, row) {
        var tmp = row['key'].split('::');
        modifyField(tmp[0], tmp[0], tmp[1], row['value']);
    });

    $.each(post, function (index, row) {
        var tmp = row['key'].split('::');
        modifyField(tmp[0], tmp[0], tmp[1], row['value']);
    });

    $.each(cookie, function (index, row) {
        var tmp = row['key'].split('::');
        modifyField(tmp[0], tmp[0], tmp[1], row['value']);
    });

    $('.add-param').click(function () {
        var type = $('select[name=type]').val();
        var key  = $('input[name=key]').val();

        modifyField(type, type, key, '');
    });

    $('#modify').submit(function () {
        return false;
    });
});
