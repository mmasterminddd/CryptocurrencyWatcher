<?php

if (isset($_POST['registerSubmit'])) {
    include 'dbc.inc.php';
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_POST = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return http_response_code(422);
    }

    $sql = 'SELECT * FROM users WHERE email=?';
    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }

    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        echo 'GET BACK TO USER WITH MESSAGE TAKEN';
    } else {
        $sql = 'INSERT INTO users (email, password, first_name, last_name) VALUES (?, ?, ?, ?)';
        $stmt = $conn->stmt_init();

        if (!$stmt->prepare($sql)) {
            return http_response_code(500);
        }

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss', $email, $hashedPwd, $firstName, $lastName);
        $stmt->execute();
        $stmt->close();

        return header('Location: ../login.php?success');

    }

} else {
    echo 'Not Submited';
    return header('Location: ../register.php');
}