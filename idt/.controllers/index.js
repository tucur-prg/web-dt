$(function () {
    $('form.credit').submit(function (ev) {
        ev.preventDefault();

        var $form = $(this);

        var cn = createNumber($form.find('[name=first]:checked').val());
        $form.find('[name=number]').val(cn);

        return false;
    });
});
