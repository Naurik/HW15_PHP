{extends file="layouts/main.tpl"}

{block name="content"}

<div class="row">

    {* Форма для изменения обычных данных *}
    <div class="col-6">
        <form method="POST" class="card card-body">
            <div class="form-group">
                <label for="">Имя пользователя</label>
                <input type="text"
                       class="form-control"
                       name="username"
                       value="{$user->username}">
            </div>
            <button class="btn btn-success">Обновить</button>
        </form>
    </div>

    {* Форма для изменения пароля *}
    <div class="col-6">
        <form action="/users/password/{$user->id}" method="POST" class="card card-body">
            <div class="form-group">
                <label for="">Пароль</label>
                <input type="password"
                       class="form-control"
                       name="password" required>
            </div>
            <button class="btn btn-success">Обновить</button>
        </form>
    </div>

</div>

{/block}
