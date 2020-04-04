{extends file="layouts/main.tpl"}

{block name="content"}
    <div class="card">
        <div class="card-header d-flex align-items-center">
            Последние книги
            <a href="/books" class="btn btn-primary btn-sm ml-auto">Все</a>
            {if $auth}
            <a href="/books/create" class="btn btn-success btn-sm ml-2">Добавить</a>
            {/if}
        </div>
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
