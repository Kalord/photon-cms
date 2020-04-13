/**
 * Обработчик отправленной формы
 */
const handler = (targetForm, success, error, async = false) => {
    let formData = new FormData(targetForm);

    $.ajax({
        type: $(targetForm).attr('method'),
        url: $(targetForm).attr('action'),
        dataType: "json",
        data: formData,
        async: async,
        success: success,
        error: error
    });
};
