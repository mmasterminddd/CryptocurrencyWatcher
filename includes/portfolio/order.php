<?php
include '../../header.php';
include '../portfolio.inc.php'; ?>


<!-- // if($_SERVER['REQUEST_METHOD'] != 'POST'){
// return header("location:".SERVER_NAME.'portfolio.php');;
// } -->

<article>
    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui header">
                <i class="fa fa-chart-pie" aria-hidden="true"></i>
                Portfolio
            </h1>
            <div style="margin-bottom: 3%">
                <h3 class="ui center aligned block header">
                    Add a new transaction
                </h3>
                <article>
                    <form class="ui form" action="save-edit.php" method="POST">
                        <div class="ui centered card">
                            <div class="content">
                                <div class="center aligned header">Select coin</div>
                                <div class="center aligned meta">
                                    <span>Search for a coin</span>
                                    <div class="ui center aligned fluid search selection dropdown">
                                        <input type="hidden" name="coin">
                                        <i class="dropdown icon"></i>
                                        <div class="default text">Select Coin</div>
                                        <div class="menu">
                                            <? foreach ($coins as $row): ?>
                                            <div class="item" data-value="<?= $row['id']?>"></i><img
                                                    src="https://s2.coinmarketcap.com/static/img/coins/32x32/<?= $row['id'] ?>.png"
                                                    class="ui mini rounded image" /><?= $row['name'] . ' (' . $row['symbol'] . ')'?>
                                            </div>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ui centered card">
                            <div class="content">
                                <div class="center aligned header">Transaction Details</div>
                                <div class="meta">
                                    <button name="buy" class="ui teal button tiny">Buy</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </article>
            </div>
        </div>
    </div>
</article>