<?php
include '../dbc.inc.php';
include '../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql = 'SELECT * FROM value_user WHERE user_id = ?';

    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }
    $stmt->bind_param('s', $_POST['user_id']);
    $stmt->execute();
    $result = $stmt->get_result();
   //
    $sqlUser = 'UPDATE users SET first_name = ?,last_name = ? ,email = ? WHERE id= ?';
    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sqlUser)) {
        return http_response_code(500);
    }

    $stmt->bind_param('ssss', $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['user_id']);
    $stmt->execute();
    $stmt->close();
    //
    if($result->num_rows == 0){
        $sql = 'INSERT INTO value_user (value,user_id) VALUES (?,?)';
    }else{
        $sql = 'UPDATE value_user SET value = ? WHERE user_id= ?';
    }

    $stmt = $conn->stmt_init();
    $value = [];
    if(!empty($_POST['value'])){
        foreach ($_POST['value'] as $key => $e){
            $newValue = new stdClass();
            $newValue->id = $e['id'];
            $newValue->quantity = $e['quantity'];
            if($e['priceWhenBought'] != '' && $e['priceWhenSell'] == ''){
                $newValue->priceWhenBought = $e['priceWhenBought'];
                $newValue->priceWhenSell = '';
                $action = 'buy';
            }else if($e['priceWhenBought'] == '' && $e['priceWhenSell'] != ''){
                $newValue->priceWhenBought = '';
                $newValue->priceWhenSell = $e['priceWhenSell'];
                $action = 'sell';
            }else{
                $newValue->priceWhenBought = $e['priceWhenBought'];
                $newValue->priceWhenSell = $e['priceWhenSell'];
                $action = 'buy/sell';
            }
            $newValue->action = $action;
            $newValue->time = date('m/d/Y h:i:s', time());
            array_push($value,$newValue);
        }
    }
    $value  = json_encode($value);
    if(empty($value)) $value = [];
    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }

    $stmt->bind_param('ss', $value, $_POST['user_id']);
    $stmt->execute();
    $stmt->close();

    return header("location:".SERVER_NAME.'admin.php');
}
?>