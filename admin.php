<?php
include 'header.php';
include 'includes/admin.inc.php';
$usersOld = $users;
uasort($users, 'mySort');

function mySort($a, $b) {
    if($a['accountValue'] == $b['accountValue']) {
        return 0;
    }
    return ($a['accountValue'] > $b['accountValue']) ? -1 : 1;
}
?>

<article>
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui header">
                <i class="fa fa-users" aria-hidden="true"></i>
                Users
            </h1>
            <div class="ui center aligned raised segment">
                <div style="margin-bottom: 3%">
                    <h3 class="ui center aligned block header">
                        Top Performing Users
                    </h3>
                    <table class="ui sortable unstackable center aligned table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>P & L</th>
                                <th>Account Value</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? $i= 0; foreach ($users as $key => $user): ?>
                            <tr style="background: <?= $user['status'] == 0 ? "grey" : ''?>">
                                <td><?= $i+1 ?></td>
                                <td><?= $user['username']?></td>
                                <td><?= $user['pnl']?>%</td>
                                <td>$<?= $user['accountValue']?></td>
                                <td>
                                    <button class="ui mini negative basic button remove_account">
                                        <form method="POST" action="includes/admin/remove.php">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <button type="submit" name="remove_account" style="display: none"></button>
                                        </form>
                                    </button>
                                    <button class="ui mini secondary basic button change_status">
                                        <form method="POST" action="includes/admin/block.php">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="status"
                                                value="<?= $user['status'] == 1 ? 0 : 1 ?>">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                            <button type="submit" name="remove_account" style="display: none"></button>
                                        </form>
                                    </button>
                                    <button class="ui mini secondary basic button edit_account">
                                        <form method="POST" action="includes/admin/edit.php">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </form>
                                    </button>
                                </td>
                            </tr>
                            <? $i++; if($i==10)  break ; endforeach;  ?>

                        </tbody>
                    </table>
                </div>
                <div>
                    <h3 class="ui center aligned block header">
                        All Users
                    </h3>
                    <table class="ui sortable unstackable center aligned table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Username</th>
                                <th>P & L</th>
                                <th>Account Value</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($usersOld as $key => $user): ?>
                            <tr style="background: <?= $user['status'] == 0 ? "grey" : ''?>">
                                <td><?= $key+1 ?></td>
                                <td><?= $user['username']?></td>
                                <td><?= $user['pnl']?>%</td>
                                <td>$<?= $user['accountValue']?></td>
                                <td>
                                    <button class="ui mini negative basic button remove_account">
                                        <form method="POST" action="includes/admin/remove.php">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                            <button type="submit" name="remove_account" style="display: none"></button>
                                        </form>
                                    </button>
                                    <button class="ui mini secondary basic button change_status">
                                        <form method="POST" action="includes/admin/block.php">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <input type="hidden" name="status"
                                                value="<?= $user['status'] == 1 ? 0 : 1 ?>">
                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                            <button type="submit" name="remove_account" style="display: none"></button>
                                        </form>
                                    </button>
                                    <button class="ui mini secondary basic button edit_account">
                                        <form method="POST" action="includes/admin/edit.php">
                                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                            <i class="fa fa-cog" aria-hidden="true"></i>
                                        </form>
                                    </button>
                                </td>
                            </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</article>
<script !src="">
$('.remove_account').on('click', function() {
    if (confirm('Are you sure?')) {
        $(this).find('form').submit();
    }
})

$('.change_status').on('click', function() {
    if (confirm('Change account status?')) {
        $(this).find('form').submit();
    }
});

$('.edit_account').on('click', function() {
    $(this).find('form').submit();
});
</script>
<?php include 'footer.php';?>