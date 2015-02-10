function readImage(file)
{
    if (!file) {
        return false;
    }

    if (!file.type.match(/image\/\w+/)) {
        alert('画像ファイル以外は利用できません。');
        return false;
    }

    var reader = new FileReader();
    reader.onload = function () {
        $('img.exif').attr('src', this.result);
        $('textarea.scheme').val(this.result);
    };

    reader.onerror = function (e) {
    };

    $('img.exif').removeAttr('src');

    reader.readAsDataURL(file);
}

$(function () {
    $(window).bind('dragover', function (event) {
        event.preventDefault();
    });

    // 画像ドロップ
    $(window).bind('drop', function (event) {
        event.preventDefault();

        if (event.originalEvent.dataTransfer.files.length == 0) {
            return;
        }

        var file = event.originalEvent.dataTransfer.files[0];

        readImage(file);
    });

    // 画像ペースト
    $(document).bind('paste', function (event) {
        if (event.originalEvent.clipboardData.items.length == 0) {
            return;
        }

        var item = event.originalEvent.clipboardData.items[0];

        readImage(item.getAsFile());
    });

    $('img.exif').load(function () {
        $(this).exifBinaryLoad(function () {
        });

        $('.exif-data').html('');
        $.each($(this).exifAll()[0], function (index, value) {
            $('.exif-data').append('<tr><td>'+index+'</td><td>'+value+'</td></tr>');
        });
    });

    $(window).load(function () {
        $('img.exif').trigger('load');
    });
});
