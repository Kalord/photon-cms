const getFindOptions = () => {
    let findOptions = {};
    let pivot = $('.admin-post-list tr').last().attr('data-id');

    if (pivot) {
        findOptions.pivot = pivot;
    }

    return findOptions;
}

const statusTitle = [
    'Удален',
    'Черновик',
    'Активен'
];

const getStatusTitle = (status) => {
    return statusTitle[status];
}

const getActionButton = (status) => {
    if (status == 0) {
        return `
            <a class="btn btn-primary">Редактировать</a>
            <a class="btn btn-primary" data-action="to-active" style="margin-top: 5px;">Восстановить</a>
            <a class="btn btn-danger" data-action="delete" style="margin-top: 5px;">Удалить безвозратно</a>
        `
    }

    if (status == 1) {
        return `
            <a class="btn btn-primary">Редактировать</a>
            <a class="btn btn-primary btn-action" data-action="to-active" style="margin-top: 5px;">Сделать активной</a>
            <a class="btn btn-danger btn-action" data-action="to-trash" style="margin-top: 5px;">Удалить</a>
        `
    }

    if (status == 2) {
        return `
            <a class="btn btn-primary">Редактировать</a>
            <a class="btn btn-primary btn-action" data-action="to-draft" style="margin-top: 5px;">В черновик</a>
            <a class="btn btn-danger btn-action" data-action="to-trash"  style="margin-top: 5px;">Удалить</a>
        `
    }
}

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

    return newAction;
};

const getActionHandler = (action) => {
    const actionHandler = {
        'to-active': '/admin/post/action/to-active',
        'to-draft': '/admin/post/action/to-draft',
        'to-trash': '/admin/post/action/to-trash',
        'detete': '/admin/post/action/delete'
    }

    return actionHandler[action];
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
                            ${action}
                        </td>
                    </tr>
                `);
            });

            $('.btn-action').click((event) => {
                let action = $(event.target).attr('data-action');
                let id = $(event.target).parent().parent().attr('data-id');

                let newAction = changeStatus(id, getActionHandler(action));

                $(event.target).parent().html(newAction);
            });
        }
    })
}

if ($('.admin-post-list').get(0)) {
    showPosts();
}

$('.show-more').click((event) => {
    showPosts();
});