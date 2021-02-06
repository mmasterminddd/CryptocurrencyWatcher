<?php
include 'dbc.inc.php';
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (!empty($_POST['submit_basic_edit'])){
        $sqlUser = 'UPDATE users SET first_name = ?,last_name = ? ,email = ? WHERE id= ?';
        $stmt = $conn->stmt_init();
        if (!$stmt->prepare($sqlUser)) {
            return http_response_code(500);
        }
        $stmt->bind_param('ssss', $_POST['first_name'], $_POST['last_name'], $_POST['email'], $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['firstname'] = $_POST['first_name'];
        $_SESSION['lastname'] = $_POST['last_name'];
        return header("location:".SERVER_NAME.'myaccount.php');
    } elseif (!empty($_POST['submit_password_edit'])) {
        $password = $_POST['password'];
        $passwordRepeat = $_POST['password_repeat'];

        if ($password === $passwordRepeat) {
            $sql = 'UPDATE users SET password = ? WHERE id=?';
            $stmt = $conn->stmt_init();

            if (!$stmt->prepare($sql)) {
                return http_response_code(500);
            }
            
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $hashedPwd , $_SESSION['id']);
            $stmt->execute();
            $stmt->close();
            session_destroy();
            return header('Location: ../login.php?success=pwchanged');
        } else {
            return header('Location: ../myaccount.php?error=nomatch');
        }
    } elseif (!empty($_POST['delete_account']))  {
        $sql = 'DELETE FROM users WHERE id=?';
        $stmt = $conn->stmt_init();

        if (!$stmt->prepare($sql)) {
            return http_response_code(500);
        }

        $stmt->bind_param('s', $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
        session_destroy();
        header("location:".SERVER_NAME.'index.php?success=deleted');
    } elseif (!empty($_POST['freeze_account']))  {
        $sql = 'UPDATE users SET status = ? WHERE id=?';
        $stmt = $conn->stmt_init();

        if (!$stmt->prepare($sql)) {
            return http_response_code(500);
        }
        
        $stmt->bind_param('is', $val = 0, $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
        session_destroy();
        return header("location:".SERVER_NAME.'index.php?success=frozen');
    } elseif (!empty($_POST['wipe_portfolio']))  {
        $sql = 'DELETE FROM value_user WHERE user_id=?';
        $stmt = $conn->stmt_init();

        if (!$stmt->prepare($sql)) {
            return http_response_code(500);
        }

        $stmt->bind_param('s', $_SESSION['id']);
        $stmt->execute();
        $stmt->close();
        header("location:".SERVER_NAME.'myaccount.php?success=portfoliowiped');
    }
} else {
    return http_response_code(500);
}