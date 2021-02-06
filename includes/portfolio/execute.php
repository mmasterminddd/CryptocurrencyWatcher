<?php
session_start();
include '../dbc.inc.php';
include '../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_SESSION['id'];
    $sql = 'SELECT * FROM value_user WHERE user_id = ?';

    $stmt = $conn->stmt_init();
    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }
    $stmt->bind_param('s', $id);
    $stmt->execute();
    $value = [];
    $checkArray = [];
    foreach ($stmt->get_result() as $key => $row)
    {
        $checkArray[] = $row;
    }
    if(empty($value)) $value = [];
    //
    if(count($checkArray) == 0){
        $sql = 'INSERT INTO value_user (value,user_id) VALUES (?,?)';
    }else{
        $sql = 'UPDATE value_user SET value = ? WHERE user_id= ?';
    }
    $stmt->close();


    $value = [];
    $stmt = $conn->stmt_init();
    if(!empty($_POST['create'])){
        $newValue = new stdClass();
        $newValue->id = $_POST['coinsCurrent'];
        $newValue->quantity = 1;
        $newValue->action =  $_POST['actionCurrent'];
        if($_POST['actionCurrent'] == 'sell'){
            $newValue->priceWhenBought = '';
            $newValue->priceWhenSell = $_POST['priceCurrent'];
        }else if($_POST['actionCurrent'] == 'buy'){
            $newValue->priceWhenBought = $_POST['priceCurrent'];
            $newValue->priceWhenSell = '';
        };
        $newValue->time = date('m/d/Y h:i:s', time());
        array_push($value,$newValue);
    };
    if(!empty($_POST['id'])){
        foreach ($_POST['id'] as $key => $e){
            $newValue = new stdClass();
            $newValue->id = $e;
            $newValue->quantity = $_POST['quantity'][$key];
            if($_POST['actionCurrent'] == 'sell' && $_POST['action'][$key] != 'buy/sell'){
                $newValue->priceWhenBought =  $_POST['priceWhenBought'][$key];
                $newValue->priceWhenSell = empty($_POST['updated'][$key]) ? $_POST['priceWhenSell'][$key] : $_POST['priceCurrent'];
            }else if($_POST['actionCurrent'] == 'buy' && $_POST['action'][$key] != 'buy/sell'){
                $newValue->priceWhenBought = empty($_POST['updated'][$key]) ? $_POST['priceWhenBought'][$key] : $_POST['priceCurrent'];
                $newValue->priceWhenSell =  $_POST['priceWhenSell'][$key];
            }else{
                if($_POST['action'][$key] == 'buy/sell'){
                    if($_POST['actionCurrent'] == 'sell'){
                        $newValue->priceWhenBought = $_POST['priceWhenBought'][$key];
                        $newValue->priceWhenSell = empty($_POST['updated'][$key]) ? $_POST['priceWhenSell'][$key] : $_POST['priceCurrent'];
                    }else if($_POST['actionCurrent'] == 'buy'){
                        $newValue->priceWhenBought = empty($_POST['updated'][$key]) ? $_POST['priceWhenBought'][$key] : $_POST['priceCurrent'];
                        $newValue->priceWhenSell = $_POST['priceWhenSell'][$key];
                    }
                };
            };
            $newValue->action = $_POST['action'][$key];
            $newValue->time = $_POST['time'][$key];
            array_push($value,$newValue);
        }
    }


    $value = json_encode($value);
    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }

    $stmt->bind_param('ss', $value, $id);
    $stmt->execute();
    $stmt->close();

    // header("location:".SERVER_NAME.'portfolio.php');
}
?>