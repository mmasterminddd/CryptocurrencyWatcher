<?php
include '../../header.php';
include '../portfolio.inc.php';
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    return header("location:".SERVER_NAME.'admin.php');;
};

$sql = 'SELECT u.id,u.first_name,u.last_name,u.email,u.status,value_user.value FROM users as u LEFT JOIN value_user ON u.id = value_user.user_id WHERE u.id = ?';
$stmt = $conn->stmt_init();
if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}
$stmt->bind_param('s',$_POST['id']);
$stmt->execute();

$users = [];
foreach ($stmt->get_result() as $row)
{
    $users['id'] = $row['id'];
    $users['username'] = $row['first_name'].' '.$row['last_name'];
    $users['first_name'] = $row['first_name'];
    $users['last_name'] = $row['last_name'];
    $users['email'] = $row['email'];
    $users['status'] = $row['status'];
    $value_user = json_decode($row['value']);
}

$stmt->close();

?>
<!-- <style>
.select2-container .select2-selection--single {
    height: 33px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 32px !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 32px !important;
}

.select2-container {
    width: 210px !important;
}
</style> -->
<article>

    <div class="ui two column centered grid">
        <div class="column">
            <h1 class="ui header">
                <i class="fa fa-users" aria-hidden="true"></i>
                Users -> Edit user -> ID:<?= $users['id']?>
            </h1>



            <div class="ui center aligned raised segment">
                <h3 class="ui center aligned block header">
                    Account Details
                </h3>


                <form class="ui form" action="save-edit.php" method="POST">
                    <input type="hidden" name="user_id" value="<?= $users['id']?>" />

                    <div class="three fields">
                        <div class="field">
                            <label>First name</label>
                            <input type="text" class="form-control first_name" value="<?= $users['first_name']?>"
                                placeholder="First Name" name="first_name">
                        </div>
                        <div class="field">
                            <label>Last name</label>
                            <input type="text" class="form-control last_name" placeholder="Last Name"
                                value="<?= $users['last_name']?>" name="last_name">
                        </div>
                        <div class="field">
                            <label>Email</label>
                            <input type="email" class="form-control email" placeholder="Last Name"
                                value="<?= $users['email']?>" name="email">
                        </div>
                    </div>

                    <h3 class="ui block header">
                        Portfolio Coins
                    </h3>
                    <div class="five fields">
                        <div class="field">Coin Name</div>
                        <div class="field">Quantity</div>
                        <div class="field">Order Price</div>
                        <div class="field">Sale Price</div>
                    </div>
                    <div class="repeater">
                        <div data-repeater-list="value">
                            <?php if( !empty($value_user) &&  count($value_user) > 0):;foreach ($value_user as $value): ?>
                            <div data-repeater-item>
                                <div class="four fields">
                                    <div class="field">
                                        <select name="id" class="coinname">
                                            <option></option>
                                            <?php foreach ($coins as $row): ?>
                                            <option <?= $value->id == $row['id'] ? 'selected' : '' ?>
                                                value="<?= $row['id']?>"><?= $row['name']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <input type="number"
                                            value="<?= !empty($value->quantity) ? $value->quantity : '' ?>"
                                            name="quantity" class="form-control quantity" placeholder="Quantity" />
                                    </div>
                                    <div class="field">
                                        <input type="number"
                                            value="<?= !empty($value->priceWhenBought) ? $value->priceWhenBought : '' ?>"
                                            name="priceWhenBought" class="form-control priceWhenBought"
                                            placeholder="Order Price" />
                                    </div>
                                    <div class="field">
                                        <input type="number"
                                            value="<?= !empty($value->priceWhenSell) ? $value->priceWhenSell : '' ?>"
                                            name="priceWhenSell" class="form-control priceWhenSell"
                                            placeholder="Sale Price" />
                                    </div>
                                    <input type="hidden" value="<?= !empty($value->action) ? $value->action : 'buy' ?>"
                                        name="action" class="form-control action" />
                                    <input type="hidden"
                                        value="<?= !empty($value->time) ? $value->time : date('m/d/Y h:i:s', time()) ?>"
                                        name="time" class="form-control time" />
                                    <div class="field">
                                        <input data-repeater-delete type="button" class="compact ui button"
                                            value="Delete" />
                                    </div>
                                </div>

                            </div>
                            <? endforeach; ?>
                            <? else: ?>
                            <div data-repeater-item>
                                <div class="four fields">
                                    <div class="field">
                                        <select name="id" class="coinname">
                                            <option></option>
                                            <? foreach ($coins as $row): ?>
                                            <option value="<?= $row['id']?>"><?= $row['name']?></option>
                                            <? endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="field">
                                        <input type="number" name="quantity" class="form-control quantity"
                                            placeholder="Quantity" />
                                    </div>
                                    <div class="field">
                                        <input type="number" name="priceWhenBought" class="form-control priceWhenBought"
                                            placeholder="Price when bought" />
                                    </div>
                                    <div class="field">
                                        <input type="number" name="priceWhenSell" class="form-control priceWhenSell"
                                            placeholder="Price when sell" />
                                    </div>
                                    <input type="hidden" value="buy" name="action" class="form-control action" />
                                    <input type="hidden" value="<?= date('m/d/Y h:i:s', time()) ?>" name="time"
                                        class="form-control time" />
                                    <div class="field">
                                        <input data-repeater-delete type="button" class="compact ui button"
                                            value="Delete" />
                                    </div>
                                </div>
                            </div>
                            <? endif; ?>
                        </div>
                        <div class="form-row" style="justify-content: flex-end;">
                            <input data-repeater-create type="button" class="compact ui button add" value="Add" />
                        </div>
                    </div>
                    <button type="submit" class="positive ui button save">Save</button>
                </form>

            </div>

        </div>
    </div>
</article>
<script !src="">
$(document).ready(function() {
    $('.repeater').repeater({});
    $('.coinname').select2({
        placeholder: "Coin name",
    });

    $('.add').on('click', function() {
        $('.coinname:last').select2({
            placeholder: "Coin name",
        });
    });

    $('.save').on('click', function(e) {
        e.preventDefault();
        var validate = true;
        if ($('body .first_name').val().length == 'undefined' || $('body .first_name').val().length ==
            0) {
            $('body .first_name').css('border', 'red 1px solid');
            validate = false;
        } else {
            $('body .first_name').css('border', '');
        }

        if ($('body .last_name').val().length == 'undefined' || $('body .last_name').val().length ==
            0) {
            $('body .last_name').css('border', 'red 1px solid');
            validate = false;
        } else {
            $('body .last_name').css('border', '');
        }

        if ($('body .email').val().length == 'undefined' || $('body .email').val().length ==
            0) {
            $('body .email').css('border', 'red 1px solid');
            validate = false;
        } else {
            $('body .email').css('border', '');
        }

        $('body .quantity').each(function() {
            var lengthValue = $(this).val().length;
            if (lengthValue == 'undefined' || lengthValue == 0) {
                $(this).css('border', 'red 1px solid');
                validate = false;
            } else {
                $(this).css('border', '');
            }
        });

        $('body .coinname').each(function() {
            var lengthValue = $(this).val().length;
            if (lengthValue == 'undefined' || lengthValue == 0) {
                $(this).next().find('.selection').find('span').first().css('border',
                    'red 1px solid');
                validate = false;
            } else {
                $(this).next().find('.selection').find('span').first().css('border', '');
            }
        });

        $('body .priceWhenBought').each(function() {
            var lengthValue = $(this).val().length;
            if (lengthValue == 'undefined' || lengthValue == 0) {
                $(this).css('border', 'red 1px solid');
                validate = false;
            } else {
                $(this).css('border', '');
            }
        });
        // $('body .priceWhenSell').each(function(){
        //     var lengthValue = $(this).val().length;
        //     if (lengthValue == 'undefined' || lengthValue == 0){
        //         $(this).css('border','red 1px solid');
        //         validate = false;
        //     }else{
        //         $(this).css('border','');
        //     }
        // });

        if (validate) {
            $(this).parents('form').submit();
        }
    });

});
</script>
<?php include '../../footer.php';?>



<!-- TODO VALIDATE EMAIL WHEN EDIT IS DONE -->