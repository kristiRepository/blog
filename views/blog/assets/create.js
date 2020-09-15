$('.create').click(function() {

    if ($(this).val() == 'add') {
        $('#create-form').attr('action', '/blog/store');

    } else {
        $('#create-form').attr('action', '/blog/draft');

    }
    $('#create-form').submit();


});

tinymce.init({
    selector: '#myTextarea'
});