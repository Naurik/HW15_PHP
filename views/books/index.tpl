{extends file="layouts/main.tpl"}

{block name="content"}
    {if $auth}
    <a href="/books/create" class="btn btn-success mb-3">Добавить</a>
    {/if}
    <div class="card">
        <ul class="list-group list-group-flush">
            {foreach $books as $book}
                <a href="/books/{$book->id}" class="list-group-item list-group-item-action">
                    {$book->name}
                </a>
                {foreachelse}
                <li class="list-group-item text-muted">Нет записей</li>
            {/foreach}
        </ul>
    </div>
{/block}
