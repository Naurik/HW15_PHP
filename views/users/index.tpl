{extends file="layouts/main.tpl"}

{block name="content"}

    <div class="mb-3">
        <a href="/users/create" class="btn btn-primary">
            Создать пользователя
        </a>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="1%" nowrap>#</th>
                <th>Имя пользователя</th>
            </tr>
        </thead>
        <tbody>
        {foreach $users as $user}
            <tr>
                <td>{$user->id}</td>
                <td>
                    <div class="d-flex align-items-center">
                        {if $user->avatar}
                            <img src="/avatar/{$user->id}" class="mr-3" style="border-radius: 999px" height="50px" alt="">
                        {/if}
                        <a href="/users/{$user->id}">
                            {$user->username}
                        </a>
                        {if $user->isAdmin()}
                            <span class="badge badge-danger badge-rounded p-1 ml-3"> </span>
                        {/if}
                    </div>
                </td>
            </tr>
        {/foreach}
        </tbody>
    </table>

{/block}
