<?php

session_start();

if (!isset($_SESSION["Id"]) || empty($_SESSION["Id"])) {
    header("Location: Login.php");
}

require_once "./Backend/DatabaseHelper.php";
$connection = DatabaseHelper::createConnection();
$id;
if (isset($_GET["Id"])) {
    $id = $_GET["Id"];
}

try {
    $query = "SELECT * FROM Products where Id = ?";
    $result = $connection->prepare($query);
    $result->execute([$id]);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error occcured: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION["Products"])) {
        if (!in_array($id, $_SESSION["Products"])) {
            $_SESSION["Products"][] = $id;
            $_SESSION["Quantities"][$id] = $_POST["Quantity"];
            header("Location: Cart.php");
        }
    } else {
        $_SESSION["Products"][] = $id;
        $_SESSION["Quantities"][$id] = $_POST["Quantity"];
    }
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
        $imageSrc = $data[0]["Image"];
        $name = $data[0]["Name"];
        $price = $data[0]["Price"];
        $desc = $data[0]["Description"];
        $quantity = $data[0]["Quantity"];
        $productInCart = false;
        if (isset($_SESSION["Products"])) {
            if (in_array($id, $_SESSION["Products"])) {
                $productInCart = true;
            } else {
                $productInCart = false;
            }
        }
        $buttonText = $productInCart ? "-- Added To Cart --" : "Add To Cart";
        echo "
        <div class='image-container'><img src='$imageSrc' class='Product Image'></div>

        <form method='POST' class='details'>
            <div class='row1'>
                <h4>$name</h4>
                <p>$ $price</p>
            </div>
            <div class='row2'>
                <p>$desc</p>
            </div>
            <div class='row3'>
                <button id='minus'><i class='fa-solid fa-minus'></i></button><input type='number' name='Quantity' value='1' max='$quantity' min='1' data-maxQuantity='$quantity'><button id='plus'><i class='fa-solid fa-plus'></i></button>
            </div>
            <div class='row4'>
                <input type='hidden' name='Id' value='$id' />
                <button type='submit'>$buttonText</button>
            </div>
        </form>";

        ?>

    </section>
</body>

</html>