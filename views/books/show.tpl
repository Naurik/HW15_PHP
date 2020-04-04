{extends file="layouts/main.tpl"}

{block name="content"}

    {if $auth}
    <div class="mb-3">
        <a href="/books/update/{$book->id}" class="btn btn-info">Изменить</a>
        <a href="/books/delete/{$book->id}"
           class="btn btn-danger"
           onclick="event.preventDefault();
                   document.getElementById('delete-{$book->id}').submit()">
            Удалить
        </a>
    </div>
    {/if}
    <form action="/books/delete/{$book->id}"
          style="display: none"
          method="POST" id="delete-{$book->id}">
    </form>

    <table class="table table-bordered">

        <tr>
            <th width="1%" nowrap>ID</th>
            <td>{$book->id}</td>
        </tr>

        <tr>
            <th>Название</th>
            <td>{$book->name}</td>
        </tr>

        <tr>
            <th>Автор</th>
            <td>{$book->user->username}</td>
        </tr>

    </table>

{/block}
