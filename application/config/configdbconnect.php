<?php
require('configuration_db.php');
$globleConnectDB = array();
try {
    $username = "j2k5e6r5_octopus";
    $password = "India$2017";
    $dbname = $activedb;

    $conn = new PDO("mysql:host=localhost;dbname=$activedb", $username, $password);


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare('SELECT * FROM configuration_site');
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $globleConnectDB = $row;
    }

    $stmt = $conn->prepare('SELECT * FROM configuration_report');
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        $globleConnectReport = $row;
    }
} catch (PDOException $e) {
    
}