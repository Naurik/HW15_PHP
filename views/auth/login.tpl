{extends file="layouts/main.tpl"}

{block name="content"}

<form method="POST">

    <div class="form-group">
        <label for="username">Имя пользователя</label>
        <input type="text" id="username" name="username" placeholder="Введите имя пользователя..." class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" id="password" name="password" placeholder="Введите пароль..." class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Войти</button>

</form>

{/block}
