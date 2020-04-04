{extends file="layouts/main.tpl"}

{block name="content"}
    <div class="card">
        <div class="card-body">
            <form action="{if $book}/books/update/{$book->id}{else}/books/create{/if}" method="POST">
                <div class="form-group">
                    <label for="name">Имя</label>
                    <input id="name"
                           class="form-control"
                           type="text"
                           name="name"
                           placeholder="Введите имя..."
                           value="{$book->name}"
                           required>
                </div>
                <button type="submit" class="btn btn-success">Сохранить</button>
            </form>
        </div>
    </div>

{/block}
