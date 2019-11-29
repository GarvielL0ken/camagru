<?php
    require_once '../config/database.php';
    require_once '../config/setup.php';

    $hash = $_GET['hash'];
    $conn = connect_to_db();
    $sql = 'SELECT username, verification_hash FROM verification_hashes WHERE verification_hash = :verification_hash';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("verification_hash" => $hash));
    $results = $stmt->fetchAll();
    $dbhash = $results[0]["verification_hash"];
    $dbusername = $results[0]["username"];
    print($dbusername);
    if ($hash != $dbhash)
        exit();
    $sql = 'UPDATE users SET verified= 1 WHERE username = :username';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("username" => $dbusername));
    $sql = 'DELETE FROM verification_hashes WHERE verification_hash = :verification_hash';
    $stmt = $conn->prepare($sql);
    $stmt->execute(array("verification_hash" => $hash));
    print("success");
    header("Location: ./login.php");
?>