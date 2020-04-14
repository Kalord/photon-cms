/**
 * Обработчик отправленной формы
 */
const handler = (targetForm, success, error, async = false) => {
    let formData;
    let type;
    let url;

    if (typeof targetForm == 'object') {
        formData = targetForm;
        type = targetForm.type;
        url = targetForm.url;
    } else {
        formData = new FormData(targetForm);
        type = $(targetForm).attr('method');
        url = $(targetForm).attr('action');
    }

    $.ajax({
        type: type,
        url: url,
        dataType: "json",
        contentType: false,
        processData: false,
        async: async,
        data: formData,
        success: success,
        error: error
    });
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});