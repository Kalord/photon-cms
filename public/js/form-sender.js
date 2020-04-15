/**
 * Отправление данных с даннми из формы
 * @param {HTML} targetForm
 * @param {callbable} success
 * @param {callbable} error
 * @param {bool} async
 */
const submitWithFormData = (targetForm, success, error, async = false) => {
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

const submitWithData = (type, url, data, success, error, async = false) => {
    $.ajax({
        type: type,
        url: url,
        dataType: "json",
        contentType: false,
        processData: false,
        async: async,
        data: data,
        success: success,
        error: error
    });
};