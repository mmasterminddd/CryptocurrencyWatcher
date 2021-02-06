<?php
include 'header.php';
include 'includes/portfolio.inc.php';
?>
<form action="includes/portfolio/execute.php" method="POST">
    <article>
        <div class="ui two column centered grid">
            <div class="column">
                <h1 class="ui header">
                    <i class="fas fa-chart-pie" aria-hidden="true"></i>
                    Portfolio
                </h1>
                <div class="ui center aligned raised segment">
                    <h3 class="ui center aligned block header">
                        Edit
                    </h3>
                    <div class="ui form">
                        <div class="fields">
                            <div class="field">
                                <select name="coinsCurrent" class="coins">
                                    <option></option>
                                    <? foreach ($coins as $row): ?>
                                    <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                    <? endforeach; ?>
                                </select>
                            </div>
                            <div class="field">
                                <input type="number" name="priceCurrent" class="price" min="0"
                                    placeholder="Enter Amount">
                            </div>
                            <div class="field">
                                <select name="actionCurrent" class="actionCurrent">
                                    <option value="">Buy / Sell</option>
                                    <option value="buy">Buy</option>
                                    <option value="sell">Sell</option>
                                    <option value="buy/sell" hidden>Hidden Option</option>
                                </select>
                            </div>
                            <input type="hidden" name="create" class="create" value="1" placeholder="Enter Amount">
                            <div class="field">
                                <div class="fluid ui button execute">Execute</div>
                            </div>
                        </div>
                    </div>
                    <h3 class="ui center aligned block header">
                        Summary
                    </h3>
                    <div>
                        <table class="ui center aligned unstackable table">
                            <thead>
                                <tr>
                                    <th>Current Value</th>
                                    <th>No of Coins</th>
                                    <th>P & L</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>$<?= !empty($user['accountValue']) ? $user['accountValue'] : '' ?></td>
                                    <td><?=  !empty($user['totalQuantity']) ?  $user['totalQuantity'] : '' ?></td>
                                    <td><?=  !empty($user['pnl']) ? $user['pnl'] : '' ?>%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <h3 class="ui center aligned block header">
                        Composition
                    </h3>
                    <div>
                        <table class="ui center aligned unstackable table">
                            <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Volume</th>
                                    <th>Buying Price</th>
                                    <th>Current Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($user['value_user'])): ?>
                                <?php foreach ($user['value_user'] as $key => $value): ?>
                                <?php if(!empty($value->action && $value->quantity != 0)): ?>
                                <tr style="<?= $value->action == 'buy/sell' ? 'display:none' : ''?>" class="check_data"
                                    data-position="<?= $key ?>" data-id="<?= $value->id?>"
                                    data-action="<?= $value->action ?>">
                                    <input type="hidden" name="id[]" value="<?= $value->id ?>">
                                    <input type="hidden" name="quantity[]" value="<?= $value->quantity ?>">
                                    <input type="hidden" name="priceWhenBought[]"
                                        value="<?= $value->priceWhenBought ?>">
                                    <input type="hidden" name="priceWhenSell[]" value="<?= $value->priceWhenSell ?>">
                                    <input type="hidden" class="updated" name="updated[]" value="0">
                                    <input type="hidden" class="time" name="time[]" value="<?= $value->time ?>">
                                    <td><?= array_key_exists($value->id,$coinsMap) ? $coinsMap[$value->id]['symbol'] : '' ?>
                                    </td>
                                    <td><?= !empty($value->action) && $value->action != 'buy/sell' ? $value->quantity : '' ?>
                                    </td>
                                    <td><?= !empty($value->priceWhenBought) ? '$'.$value->priceWhenBought : '' ?></td>
                                    <td>$<?= array_key_exists($value->id,$coinsMap) ? $coinsMap[$value->id]['btc_price'] * 9000: '' ?>
                                    </td>
                                </tr>
                                <?php endif; ?>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="ui center aligned block header">
                        History
                    </h3>
                    <div>
                        <table class="ui center aligned unstackable table">
                            <thead>
                                <tr>
                                    <th>Symbol</th>
                                    <th>Quantity</th>
                                    <th>Order Price</th>
                                    <th>Sell Price</th>
                                    <th>Profit</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <? if(!empty($user['value_user'])): ?>
                                <? foreach ($user['value_user'] as $key => $value): ?>
                                <tr>
                                    <td><?= array_key_exists($value->id,$coinsMap) ? $coinsMap[$value->id]['symbol'] : '' ?>
                                    </td>
                                    <td><?= !empty($value->quantity) ? $value->quantity : '' ?></td>
                                    <td><?= !empty($value->priceWhenBought) ? '$'.$value->priceWhenBought : '' ?></td>
                                    <td><?= !empty($value->priceWhenSell) ? '$'.$value->priceWhenSell : '' ?></td>
                                    <td>
                                        <?  $profit = null;
                                            if($value->priceWhenSell != '' && $value->priceWhenBought != ''){
                                                $profit = ((!empty($value->priceWhenSell) ? $value->priceWhenSell : 0) - (!empty($value->priceWhenBought) ? $value->priceWhenBought : 0));
                                            }
                                            ?>
                                        <?= !is_null($profit) ? '$' . $profit : $profit?>
                                    </td>
                                    <td><?= !empty($value->time) ? $value->time  : '' ?></td>
                                </tr>
                                <? endforeach; ?>
                                <? endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    </article>
</form>
<script>
$(document).ready(function() {
    let value_user = [];
    <?php if(!empty($value_user)): ?>
    value_user = JSON.parse(`<?= $value_user ?>`);
    <?php endif; ?>
    $('.coins').select2({
        placeholder: "Select coin",
    });
    $('button').on('click', function(e) {
        e.preventDefault();
    })
    $('.execute').on('click', function(e) {
        let actionMap = [];
        e.preventDefault();
        $('.check_data').each(function(i, v) {
            let id = $(v).attr('data-id');
            let action = $(v).attr('data-action');
            let position = $(v).attr('data-position');
            if (action !== 'buy/sell') {
                let array = {
                    id: id,
                    action: action,
                    position: position
                }
                actionMap[id] = array;
            }
        });
        var validate = true;
        let price = $('body .price').val();
        if ($('body .price').val().length == 'undefined' || $('body .price').val().length == 0) {
            $('body .price').css('border', 'red 1px solid');
            validate = false;
        } else {
            $('body .price').css('border', '');
        }
        let actionCurrent = $('body .actionCurrent').val();
        if ($('body .actionCurrent').val().length == 'undefined' || $('body .actionCurrent').val()
            .length == 0) {
            $('body .actionCurrent').css('border', 'red 1px solid');
            validate = false;
        } else {
            $('body .actionCurrent').css('border', '');
        }

        var lengthValue = $('.coins').val().length;
        if (lengthValue == 'undefined' || lengthValue == 0) {
            $('.coins').next().find('.selection').find('span').first().css('border', 'red 1px solid');
            validate = false;
        } else {
            $('.coins').next().find('.selection').find('span').first().css('border', '');
            let coin = $('.coins').val();
            if (actionMap.hasOwnProperty(coin)) {
                if (actionMap[coin].action === 'buy' && actionCurrent === 'buy') {
                    $('body .actionCurrent').css('border', 'red 1px solid');
                    validate = false;
                } else if (actionMap[coin].action === 'sell' && actionCurrent === 'sell') {
                    $('body .actionCurrent').css('border', 'red 1px solid');
                    validate = false;
                } else {
                    $('body .action').eq(actionMap[coin].position).val('buy/sell');
                    $('body .updated').eq(actionMap[coin].position).val(1);
                    $('body .create').val(0);
                    $('body .actionCurrent').css('border', '');
                };
            }
        }


        if (validate) {
            $(this).parents('form').submit();
        }
    });
});
</script>
<?php include 'footer.php';?>