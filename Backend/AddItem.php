<?php

require_once './DatabaseHelper.php';

if (!empty($_POST["Name"]) && !empty($_POST["Description"]) && !empty($_POST["Price"]) && !empty($_POST["Quantity"]) && !empty($_POST["Category"]) && isset($_FILES["Image"])) {

    $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];  // define allowed types
    $allowedExtensions = ['png', 'jpg', 'jpeg']; // define allowed extensions

    $fileType = $_FILES['Image']['type']; // get file type
    $fileExtension = pathinfo($_FILES['Image']['name'], PATHINFO_EXTENSION); // get file extension

    if (in_array($fileType, $allowedTypes) && in_array($fileExtension, $allowedExtensions)) {

        $targetFile  = "Uploads/" . $_POST["Name"] . '.' . $fileExtension;

        if (move_uploaded_file($_FILES['Image']['tmp_name'], $targetFile)) {

            $data = validateInput($_POST);
            if ($data) {
                $connection = DatabaseHelper::createConnection();
                $query = "INSERT INTO products (Name, Description, Price, Category ,Quantity,Image) VALUES (?, ?, ?, ?, ?, ?)";
                $result = $connection->prepare($query);
                $result->execute([$data["Name"], $data["Description"], $data["Price"], $data["Category"], $data["Quantity"], "./Backend/" . $targetFile]);
                $productId = $connection->lastInsertId();
                echo $productId;
                if ($productId) {
                    header("Location: ../Products.php#$id");
                    exit();
                }
            } else {
                echo "Failed to process data.";
            }
        } else {
            echo "Failed to upload the image.";
        }
    } else {
        echo "Image type is not allowed.";
    }
} else {
    echo "All fields are required.";
}

function validateInput($array)
{
    if (is_numeric($array["Quantity"]) && is_numeric($array["Price"])) {
        $price = (float) round((float) $array["Price"], 2);
        $quantity = (int) $array["Quantity"];
        $newArray = $array;
        $newArray["Price"] = $price;
        $newArray["Quantity"] = $quantity;
        return $newArray;
    } else {
        return false;
    }
}
