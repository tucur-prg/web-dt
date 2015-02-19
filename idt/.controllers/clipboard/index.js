document.onpaste = function (ev) {
    var type = ev.clipboardData.types;

    for (var i = 0; i < ev.clipboardData.items.length; i++) {
        var data = ev.clipboardData.items[i];
        if (data.type == "image/png") {
            var fr = new FileReader();

            fr.onloadend = function() {
//                $("#clip").attr('src', this.result);

                $.post('clipboard%3Asave/', this.result, function (imgPath) {
                    location.href = imgPath;
                });
            };

            fr.readAsDataURL(data.getAsFile());
            break;
        }
    }
}

function getPosT(ev) {
    var rect      = ev.target.getBoundingClientRect();

    var positionX = ev.clientX - rect.left;
    var positionY = ev.clientY - rect.top;

    return {x:positionX, y:positionY};
}

$(function () {
    var drawing   = false;
    var addString = false;
    var oldPos;

    var index = 0;
    var snapshot = [];

    var canvas = document.getElementById('board');
    if (!canvas) {
        return false;
    }

    var ctx = canvas.getContext('2d');

    var path = $(canvas).attr('jq-img-path');

    var img = new Image();
    img.onload = function () {
        canvas.width  = img.width;
        canvas.height = img.height;

        ctx.drawImage(img, 0, 0);

        ctx.strokeStyle = 'black';
        ctx.fillStyle   = 'black';

        ctx.font = '14px Arial';

        ctx.lineWidth   = 5;
        ctx.lineJoin    = 'round';
        ctx.lineCap     = 'round';

        snapshot[0] = ctx.getImageData(0, 0, img.width, img.height);
    };

    img.src = ".tmp/" + path;

    canvas.addEventListener('mousedown', function (ev) {
        if (addString) {
            var pos = getPosT(ev);

            $('<textarea>')
                .addClass('flat-text string')
                .css({ top:ev.clientY, left:ev.clientX + 1, font:ctx.font, color:ctx.fillStyle })
                .on('blur', function (ev) {
                    var text = $(this).val();
                    if (text) {
                        var lines = text.split('\n');
                        var height = ctx.measureText("あ").width;

                        lines.forEach(function (line, i) {
                            ctx.fillText(line, pos.x, pos.y + 14 + (height * i));
                        });
                    }

                    $(this).remove();
                    $('.jq-string').removeClass('on');
                })
                .appendTo('body');

            return false;
        }

        drawing   = true;
        oldPos    = getPosT(ev);
    }, false);

    canvas.addEventListener('mouseup', function (ev) {
        if (addString) {
            $('textarea.string')
                .focus();

            addString = false;

            return false;
        }

        drawing = false;

        index++;
        snapshot[index] = ctx.getImageData(0, 0, img.width, img.height);
    }, false);

    canvas.addEventListener('mousemove', function (ev) {
        var pos = getPosT(ev);
        if (drawing) {
            ctx.beginPath();
            ctx.moveTo(oldPos.x, oldPos.y);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
            ctx.closePath();

            oldPos = pos;
        }
    }, false);

    canvas.addEventListener('mouseout', function (ev) {
        if (drawing) {
            drawing = false;

            index++;
            snapshot[index] = ctx.getImageData(0, 0, img.width, img.height);
        }
    }, false);

    $('[jq-color]').click(function (ev) {
        $('[jq-color]').removeClass('on');
        $(this).addClass('on');

        ctx.strokeStyle = $(this).attr('jq-color');
        ctx.fillStyle   = $(this).attr('jq-color');
    });

    $('[jq-width]').click(function (ev) {
        $('[jq-width]').removeClass('on');
        $(this).addClass('on');

        ctx.lineWidth = $(this).attr('jq-width');
        ctx.lineJoin  = 'round';
        ctx.lineCap   = 'round';
    });

    $('.jq-new').click(function (ev) {
        location.href = 'clipboard/';
    });

    $('.jq-save').click(function (ev) {
        $.post('clipboard%3Asave/', canvas.toDataURL(), function (imgPath) {
            location.href = imgPath;
        });
    });

    $('.jq-delete').click(function (ev) {
        if (confirm('画像を削除しますか？')) {
            location.href = "clipboard%3Aremove/?path=" + path;
        }
    });

    $('.jq-undo').click(function (ev) {
        if (snapshot[index-1]) {
            index--;
            ctx.putImageData(snapshot[index], 0, 0);
        }
    });

    $('.jq-redo').click(function (ev) {
        if (snapshot[index+1]) {
            ctx.putImageData(snapshot[index+1], 0, 0);
            index++;
        }
    });

    $('.jq-string').click(function (ev) {
        $(this).addClass('on');
        addString = true;
    });
});
