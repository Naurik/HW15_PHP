{extends file="layouts/main.tpl"}

{block name="content"}

    <div class="card card-body mb-3">

        {if $auth_user->avatar}
            <img src="/avatar/{$auth_user->id}" alt="Avatar" class="rounded" width="100px">
        {/if}

        <h1 class="display-4">
            {$auth_user->username}
        </h1>
    {if $auth_user->isAdmin()}
        <p class="lead text-danger">
            Администратор
        </p>
    {/if}
    </div>

    <form action="/profile/avatar" class="card card-body mb-3" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <h4>Изменить аватар</h4>
            <input type="file" name="avatar">
        </div>
        <button class="btn btn-primary">Загрузить</button>
    </form>

    <form action="/profile/password" method="POST" class="card card-body" id="password-change">
        <div class="form-group">
            <label for="">Пароль</label>
            <input type="password"
                   class="form-control"
                   name="password" required>
        </div>
        <div class="form-group">
            <label for="">Подтверждение</label>
            <input type="password"
                   class="form-control"
                   name="password_confirm" required>
        </div>
        <button class="btn btn-success">Обновить</button>
    </form>
    <script>

        $('#password-change').on('submit', function (event) {
            event.preventDefault();

            let action = $(this).attr('action');
            let values = $(this).serialize();
            $.post(action, values, function (data) {
                alert(data.message);
            }, 'json').fail(function () {
                alert('Server error');
            });

            return false;
        });

    </script>

{/block}
