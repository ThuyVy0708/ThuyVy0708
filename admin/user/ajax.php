<?php
require_once('../database/dbhelper.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = 'DELETE FROM user WHERE id_user = ' . $id;
    execute($sql);
    echo json_encode(['status' => 'success']);
    exit;
}
?>
