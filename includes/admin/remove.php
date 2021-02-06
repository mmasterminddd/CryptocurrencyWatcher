<?php
include '../dbc.inc.php';
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $sql = 'DELETE FROM users WHERE id=?';
    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }

    $stmt->bind_param('s', $_POST['id']);
    $stmt->execute();
    $stmt->close();
    return header("location:".SERVER_NAME.'admin.php');
}
?>