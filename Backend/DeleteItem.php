<?php

require_once './DatabaseHelper.php';

if (!empty($_POST["Id"])) {

    $connection = DatabaseHelper::createConnection();
    $query = "SELECT Image FROM products WHERE Id = ?";
    $result = $connection->prepare($query);
    $result->execute([$_POST["Id"]]);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    $imageURL = "." . substr($data[0]["Image"], 9);
    $query = "DELETE FROM products WHERE Id = ?";
    $result = $connection->prepare($query);
    $result->execute([$_POST["Id"]]);
    $rowsAffected = $result->rowCount();
    if ($rowsAffected) {
        unlink($imageURL);
        header("Location: ../Products.php");
        exit();
    }
    else{
        echo "Error occurred";
    }
}

function validateInput($array) {}
