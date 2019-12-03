<?php
    require_once '../config/database.php';
    require_once '../config/setup.php';
    require_once '../config/lib.php';

    $hash = $_GET['hash'];
    $conn = connect_to_db();
    $dbusername = valid_hash($hash, 'new_user_hash');
    if (!$dbusername)
        exit();
    $sql = 'UPDATE users SET verified= 1 WHERE username = :username';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("username" => $dbusername));
    $sql = 'DELETE FROM verification_hashes WHERE verification_hash = :verification_hash';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("verification_hash" => $hash));
    header("Location: ./login.php");
?>