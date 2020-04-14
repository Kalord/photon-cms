$('.login-form').submit((event) => {
    event.preventDefault();

    const success = () => {
        $('.error-message').hide();
        window.location.href = '/';
    };

    const error = (html) => {
        $('.error-message').show();
        $('.error-message').html(getFirstProperty(html.responseJSON.errors)[0]);
    };

    handler(event.target, success, error);
});