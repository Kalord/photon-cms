/**
 * Обработчик отправленной формы
 */
const handler = (targetForm, success, error, async = false) => {
    let formData = new FormData(targetForm);

    $.ajax({
        type: $(targetForm).attr('method'),
        url: $(targetForm).attr('action'),
        dataType: "json",
        contentType: false,
        processData: false,
        async: async,
        data: formData,
        success: success,
        error: error
    });
};