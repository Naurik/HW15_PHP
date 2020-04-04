{extends file="layouts/main.tpl"}

{block name="content"}

    <div class="mb-3 d-flex">
        <a href="/users/update/{$user->id}" class="btn btn-info mr-3">Изменить</a>
        <a href="/users/delete/{$user->id}"
           class="btn btn-danger"
           onclick="event.preventDefault();
                   document.getElementById('delete-{$user->id}').submit()">
            Удалить
        </a>
        <a href="#" id="admin-toggle" data-id="{$user->id}" class="btn btn-info ml-auto">
            Сделать {if $user->isAdmin()}не админом{else}админом{/if}
        </a>
    </div>
    <form action="/users/delete/{$user->id}"
          style="display: none"
          method="POST" id="delete-{$user->id}">
    </form>
<div class="card card-body">

    <h1 class="display-4">
        {$user->username}
    </h1>
{if $user->isAdmin()}
    <p class="lead text-danger">
        Администратор
    </p>
{/if}

</div>
<script>

    let btn = $('#admin-toggle');
    let id = btn.data('id');

    function getMessage(data) {
        console.error(data);
    }

    btn.on('click', function (event) {
        event.preventDefault();

        $.post('/users/toggle/' + id, function (data) {

            if (data.code === 200)
                location.reload();
            else
                getMessage(data.message);

        }, 'json').fail(function (data) {
            getMessage('Some error');
        });

    });

</script>

{/block}
