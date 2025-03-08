<?php

session_start();
require_once "./Backend/DatabaseHelper.php";
$connection = DatabaseHelper::createConnection();

// page protection
if (isset($_GET["Id"])) {
    $id = $_GET["Id"];
    if (!is_numeric($id)) {
        header("Location: ./Products.php");
        exit();
    }
    try {
        $query = "SELECT * FROM Products where Id = ?";
        $result = $connection->prepare($query);
        $result->execute([$id]);
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        if (!isset($data[0]['Id'])) {
            header("Location: ./Products.php");
            exit();
        }
        $product = $data[0];
    } catch (PDOException $e) {
        // handle error
    }
} else {
    header('Location: ./Products.php');
    exit();
}

$productInCart = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['Id']) && !empty($_SESSION['Id'])) {
        if (isset($_SESSION["Products"])) {
            if (!in_array($id, $_SESSION["Products"])) {
                $_SESSION["Products"][] = $id;
                $_SESSION["Quantities"][$id] = $_POST["Quantity"];
            }
            else{
                $_SESSION["Quantities"][$id] = $_POST["Quantity"];
            }
        } else {
            // first time
            $_SESSION["Products"][] = $id;
            $_SESSION["Quantities"][$id] = $_POST["Quantity"];
        }
        $productInCart = true;
        header("Location: Cart.php");
    } else {
        header('Location: ./Login.php');
    }
}

function displayProduct($product)
{
    $id = $product["Id"];
    $imageSrc = $product["Image"];
    $name = $product["Name"];
    $price = $product["Price"];
    $desc = $product["Description"];
    $quantity = $product["Quantity"];
    $chosenValue = 1;
    if (inCart($id)) {
        $chosenValue = $_SESSION['Quantities'][$id];
    }
    $buttonText = inCart($id) ? "-- Edit Quantity --" : "Add To Cart";
    echo "
        <div class='image-container'><img src='$imageSrc' class='Product Image'></div>

        <form method='POST' class='details'>
            <div class='row1'>
                <h4>$name</h4>
                <p>$$price</p>
            </div>
            <div class='row2'>
                <p>$desc</p>
            </div>
            <div class='row2'>
                <p>Available Quantity $quantity</p>
            </div>
            <div class='row3'>
                <button type='button' id='minus'><i class='fa-solid fa-minus'></i></button>
                <input type='number' id='productQuantity' name='Quantity' value='$chosenValue' max='$quantity' min='1' data-maxQuantity='$quantity'>
                <button type='button' id='plus'><i class='fa-solid fa-plus'></i></button>
            </div>
            <div class='row4'>
                <input type='hidden' name='Id' value='$id' />
                <button type='submit'>$buttonText</button>
            </div>
        </form>";
}

function inCart($id)
{
    $available = false;
    if (isset($_SESSION['Products'])) {
        for ($i = 0; $i < count($_SESSION['Products']); $i++) {
            if ($_SESSION['Products'][$i] == $id) $available = true;
        }
    }
    return $available ? true : false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Products</title>
    <link rel="stylesheet" href="./Styles/products.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="./Script/script.js"></script>
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
</head>

<body>
    <section class="product-details">
        <?php
        displayProduct($product);
        ?>
    </section>
</body>

</html>