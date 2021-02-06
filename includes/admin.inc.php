<?php


include 'dbc.inc.php';
$sql = 'SELECT id,btc_price FROM coins';
$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}

$stmt->execute();

$coins = [];
foreach ($stmt->get_result() as $row)
{
    $coins[$row['id']] = $row['btc_price'];
}

$stmt->close();


$sql = 'SELECT u.id,u.first_name,u.last_name,u.status,value_user.value FROM users as u LEFT JOIN value_user ON u.id = value_user.user_id ORDER BY id DESC';
$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}

$stmt->execute();

$users = [];
$i = 0;
foreach ($stmt->get_result() as $row)
{
    $amountCoin = 0;
    $accountValue = 0;
    $totalPriceWhenBought = 0;
    $totalQuantity = 0;
    $priceRightNow = 0;
    $pnl = 0;
    $users[$i]['id'] = $row['id'];
    $users[$i]['username'] = $row['first_name'].' '.$row['last_name'];
    $users[$i]['status'] = $row['status'];
    $value = json_decode($row['value']);
    if(!empty($value)){
        foreach ($value as $e){
            $accountValue += (!empty($e->priceWhenBought) ? $e->priceWhenBought : 0) * $e->quantity;
            $amountCoin += $e->quantity;
            $totalPriceWhenBought += (!empty($e->priceWhenBought) ? $e->priceWhenBought : 0);
            $totalQuantity +=  $e->quantity;
            if(array_key_exists($e->id,$coins)) {
                $priceRightNow += $coins[$e->id] * 9000;
            }
        }

         $pnl = $totalQuantity * ($priceRightNow - $totalPriceWhenBought);
    };


    $users[$i]['accountValue'] = $accountValue;
    $users[$i]['pnl'] = $pnl;
    $i++;
}

$stmt->close();

?>