$('.registration-form').submit((event) => {
    event.preventDefault();

    const success = () => {
        $('#name').html($('[name="name"]').val());
        $('.error-message').hide();
        $('.error-message').show();

        setTimeout(() => {
            window.location.href = '/login';
        }, 300);
    };

    const error = (html) => {
        $('.error-message').show();
        $('.error-message').html(getFirstProperty(html.responseJSON.errors)[0]);
    }

    submitWithFormData(event.target, success, error);
});