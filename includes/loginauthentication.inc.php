<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'dbc.inc.php';
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
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstname'] = $row['first_name'];
            $_SESSION['lastname'] = $row['last_name'];
            $_SESSION['preffered_fiat'] = $row['preffered_fiat'];
            if (isset($_SESSION['id'])) {
                return header('Location: ../index.php?login=success');
            }
        }
    } else {
        return header('Location: ../login.php?login=wrongcreds');
    }

} else {
    return header('Location: ../login.php');
}

#TO-DO
#redirect with get if wrong creds and show a message.