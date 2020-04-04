<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$title} | {$app.name}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>
<body>

<div class="container">
    <div class="navbar navbar-light bg-light navbar-expand-lg border my-3 rounded">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    Главная
                </a>
            </li>
            <li class="nav-item mr-auto">
                <a href="/books" class="nav-link">
                    Книги
                </a>
            </li>

        {if $auth == true && $auth_user->isAdmin()}
            <li class="nav-item mr-auto">
                <a href="/users" class="nav-link">
                    Пользователи
                </a>
            </li>
        {/if}

        </ul>

        <ul class="navbar-nav ml-auto">
            {if $auth == true}
                <li class="navbar-text mr-3">
                    {$auth_user->username}
                    {if $auth_user->isAdmin()}
                    <span class="badge badge-primary">администратор</span>
                    {/if}
                </li>
                <li class="nav-item">
                    <a href="/logout" class="nav-link text-danger">
                        Выйти
                    </a>
                </li>
            {else}
                <li class="nav-item">
                    <a href="/login" class="nav-link">
                        Войти
                    </a>
                </li>
            {/if}
        </ul>
    </div>

    {block name="content"}{/block}
</div>

</body>
</html>
