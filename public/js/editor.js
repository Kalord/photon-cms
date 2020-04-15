const getEditorData = () => {
    let formData = new FormData();

    formData.append('title', $('.input-title').val());
    formData.append('description', $('.description').val());
    formData.append('keywords', $('.keywords').val());
    formData.append('id_category', $('.categories option:selected').val());
    formData.append('main_img', $('.main-img').prop('files')[0]);
    formData.append('alt_main_img', $('.alt-main-img').val());
    formData.append('content', $('.note-editable').html());
    formData.append('_token', $('[name="_token"]').val());

    return formData;
}

$('.btn-save').click((event) => {
    let data = getEditorData();
    data.append('status', $(event.target).attr('data-status'));

    const success = (html) => {
        console.log(html);
    };

    const error = (html) => {
        $('.error-message').show();
        $('.error-message').html(getFirstProperty(html.responseJSON.errors)[0]);
    };

    submitWithData('POST', '/admin/post/create', data, success, error);
});