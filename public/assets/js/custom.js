$(document).ready(function () {
    $('#back_redirect').click(function () {
        history.go(-1);
    });

    $(document).on("change", '.js-select2', function() {
        // $(this).next().hide()
        $(this).parent('div').find('label.error').hide()
    });
});