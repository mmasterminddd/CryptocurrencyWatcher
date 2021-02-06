<?php
include '../dbc.inc.php';
include '../config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['status'])) {
    $sql = 'UPDATE users SET status = ? WHERE id=?';
    $stmt = $conn->stmt_init();

    if (!$stmt->prepare($sql)) {
        return http_response_code(500);
    }

    $stmt->bind_param('ss', $_POST['status'], $_POST['id']);
    $stmt->execute();
    $stmt->close();
    return header("location:".SERVER_NAME.'admin.php');
}
?>