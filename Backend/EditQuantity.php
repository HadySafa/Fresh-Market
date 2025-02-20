<?php

require_once './DatabaseHelper.php';

if (!empty($_POST["Id"]) && !empty($_POST["Quantity"])) {

    $array = validateInput($_POST);

    if ($array) {
        $connection = DatabaseHelper::createConnection();
        $query = "UPDATE products SET Quantity = ? WHERE Id = ?";
        $result = $connection->prepare($query);
        $result->execute([$array["Quantity"], $array["Id"]]);
        $rowsAffected = $result->rowCount();
        if ($rowsAffected) {
            header("Location: ../Products.php");
            exit();
        } else {
            echo "Error occurred";
        }
    }
    else{
        echo "Incorrect input";
    }

} else {
    echo "All fields are required";
}

function validateInput($array)
{
    $quantity = $array["Quantity"];
    if (is_numeric($quantity)) {
        $quantity = (int)$quantity;
    }
    $tempArray = $array;
    $tempArray["Quantity"] = $quantity;
    return $tempArray;
}
