const getEditorData = () => {
    return {
        title: $('.title').val(),
        description: $('.description').val(),
        keywords: $('.keywords').val(),
        id_category: $('.categories option:selected').val(),
        main_img: $('.main-img').prop('files')[0],
        alt_main_img: $('.alt-main-img').val(),
        content: $('.note-editable').html(),
        _token: $('[name="_token"]').val()
    }
}

$('.btn-save').click((event) => {
    let data = getEditorData();
    data.status = $(event.target).attr('data-status');

    const success = (html) => {
        console.log(html);
    };

    const error = (html) => {
        $('.error-message').show();
        $('.error-message').html(getFirstProperty(html.responseJSON.errors)[0]);
    };

    submitWithData('POST', '/admin/post/create', data, success, error);
});