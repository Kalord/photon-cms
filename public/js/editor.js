let imgSrc = [];

/**
 * Отсчистка src у img
 * src сохраняются в массив imgSrc
 */
const cleanImg = () => {
    imgSrc = [];

    let imgs = $('.note-editable img');

    for (let i = 0; i < imgs.length; i++) {
        let img = $(imgs[i]);
        imgSrc.push(img.attr('src'));
        img.attr('src', "");
    }
};

/**
 * Вставка src в img
 * src берутся из массива imgSrc
 */
const insertImg = () => {
    let imgs = $('.note-editable img');

    for (let i = 0; i < imgs.length; i++) {
        let img = $(imgs[i]);
        let src = imgSrc[i];
        img.attr('src', src);
    }

    imgSrc = [];
};

/**
 * Получение данных редактора
 *
 * @returns {FormData}
 */
const getEditorData = () => {
    let formData = new FormData();

    formData.append('title', $('.input-title').val());
    formData.append('description', $('.description').val());
    formData.append('keywords', $('.keywords').val());
    formData.append('id_category', $('.categories option:selected').val());
    formData.append('main_img', $('.main-img').prop('files')[0]);
    formData.append('alt_main_img', $('.alt-main-img').val());

    cleanImg();
    formData.append('content', $('.note-editable').html());
    insertImg();

    formData.append('_token', $('[name="_token"]').val());
    let files = getFiles();
    for (let i = 0; i < files.length; i++) {
        formData.append(`resource-${i}`, files[i]);
    }

    return formData;
};

/**
 * Сохранение публикации
 */
$('.btn-save').click((event) => {
    let data = getEditorData();
    data.append('status', $(event.target).attr('data-status'));

    const success = (html) => {
        window.location.href = '/admin/post';
    };

    const error = (html) => {
        $('.error-message').show();
        $('.error-message').html(getFirstProperty(html.responseJSON.errors)[0]);
    };

    submitWithData('POST', '/admin/post/create', data, success, error);
    insertImg();
});