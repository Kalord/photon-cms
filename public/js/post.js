/**
 * Поисковые параметры
 * @return object
 **/
const getFindOptions = () => {
    let findOptions = {};
    let pivot = $('.admin-post-list tr').last().attr('data-id');

    if (pivot) {
        findOptions.pivot = pivot;
    }

    return findOptions;
}

/**
 * Заголовки статусов
 * @var object
 **/
const statusTitle = [
    'Удален',
    'Черновик',
    'Активен'
];

/**
 * Получение загловка статуса по идентификатору
 * @param {int} status
 **/
const getStatusTitle = (status) => {
    return statusTitle[status];
}

/**
 * Получение кнопок действий в зависимости от статуса публикации
 *
 * @param {int} status
 *
 * @returns string
 **/
const getActionButton = (status) => {
    if (status == 0) {
        return `
            <a class="btn btn-primary btn-action" data-action="to-active" style="margin-top: 5px;">Восстановить</a>
            <a class="btn btn-danger btn-delete" data-action="delete" style="margin-top: 5px;">Удалить безвозратно</a>
        `
    }

    if (status == 1) {
        return `
            <a class="btn btn-primary btn-action" data-action="to-active" style="margin-top: 5px;">Сделать активной</a>
            <a class="btn btn-danger btn-action" data-action="to-trash" style="margin-top: 5px;">Удалить</a>
        `
    }

    if (status == 2) {
        return `
            <a class="btn btn-primary btn-action" data-action="to-draft" style="margin-top: 5px;">В черновик</a>
            <a class="btn btn-danger btn-action" data-action="to-trash"  style="margin-top: 5px;">Удалить</a>
        `
    }
}

/**
 * Изменение статуса публикации
 *
 * @param {int} id_post
 * @param {string} url
 *
 * @return string
 **/
const changeStatus = (id_post, url) => {
    let newAction;

    $.ajax({
        type: 'POST',
        url: url,
        async: false,
        data: {
            id: id_post,
            _token: $('[name="_token"]').val()
        },
        success: (html) => {
            newAction = getActionButton(html);
        }
    })

    return '<a href="#" class="btn btn-primary">Редактировать</a>' + newAction;
};

/**
 * Получение URL обработчиков действий
 *
 * @return string
 **/
const getActionHandler = (action) => {
    const actionHandler = {
        'to-active': '/admin/post/action/to-active',
        'to-draft': '/admin/post/action/to-draft',
        'to-trash': '/admin/post/action/to-trash'
    }

    return actionHandler[action];
}

const btnActionHandler = (event) => {
    let action = $(event.target).attr('data-action');
    let id = $(event.target).parent().parent().attr('data-id');

    let newAction = changeStatus(id, getActionHandler(action));

    $(event.target).parent().html(newAction);
}

const btnDeleteHandler = (event) => {
    let id = $(event.target).parent().parent().attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/admin/post/action/delete',
        data: {
            id: id,
            _token: $('[name="_token"]').val()
        },
        success: () => {
            $(event.target).parent().parent().remove();
        }
    })
}

let showPosts = () => {
    $.ajax({
        type: 'GET',
        url: '/post/find',
        data: getFindOptions(),
        async: false,
        success: (html) => {

            html.forEach((post) => {
                let action = getActionButton(post.status);
                $('.table-content').append(`
                    <tr data-id="${post.id}">
                        <th scope="row">${post.id}</th>
                        <td>${post.title}</td>
                        <td>${post.category_title}</td>
                        <td>${post.user_name}</td>
                        <td><img src="${post.main_img}" width="100"></td>
                        <td>${getStatusTitle(post.status)}</td>
                        <td>${post.view}</td>
                        <td>
                            <a href="/admin/post/update/${post.id}" class="btn btn-primary">Редактировать</a>
                            ${action}
                        </td>
                    </tr>
                `);
            });

            $('.btn-action').click(btnActionHandler);
            $('.btn-delete').click(btnDeleteHandler);
        }
    })
}

if ($('.admin-post-list').get(0)) {
    showPosts();
}

$('.show-more').click((event) => {
    showPosts();
});