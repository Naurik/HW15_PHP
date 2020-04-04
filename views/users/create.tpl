{extends file="layouts/main.tpl"}

{block name="content"}

<div class="card card-body">

    <form method="POST">
        <div class="form-group">
            <label for="">Имя пользователя</label>
            <input type="text" class="form-control" name="username">
        </div>
        <div class="form-group">
            <label for="">Пароль</label>
            <input type="password" class="form-control" name="password">
        </div>
        <button class="btn btn-success">Сохранить</button>
    </form>

</div>

{/block}
