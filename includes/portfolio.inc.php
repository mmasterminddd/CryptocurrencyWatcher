<?php
    include 'dbc.inc.php';
    $sql = 'SELECT * FROM coins ORDER BY rank asc';
    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }

    $stmt->execute();
    $coinsMap = [];
    $coins = [];
    $i = 0;
    foreach ($stmt->get_result() as $row)
    {
        $coins[$i]['id'] = $row['id'];
        $coins[$i]['name'] = $row['name'];
        $coins[$i]['symbol'] = $row['symbol'];

        $coinsMap[$row['id']] = ['btc_price' => $row['btc_price'],'symbol' => $row['symbol'], 'name' => $row['name'] ];
        $i++;
    }

    $stmt->close();
//

$sql = 'SELECT u.id,u.first_name,u.last_name,u.status,value_user.value FROM users as u LEFT JOIN value_user ON u.id = value_user.user_id WHERE u.id = ? ORDER BY id DESC';
$stmt = $conn->stmt_init();

if (!$stmt->prepare($sql)) {
    return http_response_code(500);
}
$stmt->bind_param('s',$_SESSION['id']);
$stmt->execute();

$user = [];
$i = 0;
$value_user = '';
foreach ($stmt->get_result() as $row)
{
    $amountCoin = 0;
    $accountValue = 0;
    $totalPriceWhenBought = 0;
    $totalQuantity = 0;
    $priceRightNow = 0;
    $pnl = 0;
    $user['id'] = $row['id'];
    $user['username'] = $row['first_name'].' '.$row['last_name'];
    $user['status'] = $row['status'];
    $user['value_user'] = json_decode($row['value']);
    $value_user = $row['value'];
    if(!empty($user['value_user'])){
        foreach ($user['value_user'] as $e){
            $accountValue += (!empty($e->priceWhenBought) ? $e->priceWhenBought : 0) * $e->quantity;
            $amountCoin += $e->quantity;
            $totalPriceWhenBought += !empty($e->priceWhenBought) ? $e->priceWhenBought : 0;
            if($e->action !=  'buy/sell'){
                $totalQuantity +=  $e->quantity;
            }
            if(array_key_exists($e->id,$coinsMap)) {
                $priceRightNow += $coinsMap[$e->id]['btc_price'] * 9000;
            }
        }

        $pnl = $totalQuantity * ($priceRightNow - $totalPriceWhenBought);
    };

    $user['totalQuantity'] = $totalQuantity;
    $user['accountValue'] = $accountValue;
    $user['pnl'] = $pnl;
    $i++;
}

$stmt->close();
?>