<?php

require_once "./Backend/DatabaseHelper.php";

try {
    $query = "SELECT * FROM Products";
    $connection = DatabaseHelper::createConnection();
    $result = $connection->query($query);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // handle error
}

function displayLink($data)
{
    $image = $data["Image"];
    $name = $data["Name"];
    $id = $data["Id"];
    echo "<a class='product' href='./Product-Details.php?Id=$id' id='$id'>
          <img src='$image' alt='Product Image.'>
          <p>$name</p><i class='fa-solid fa-arrow-right'></i>
          </a>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Products</title>
    <link rel="stylesheet" href="./Styles/header.css" />
    <link rel="stylesheet" href="./Styles/products.css" />
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="./Script/script.js"></script>
</head>

<body>
    <div class="mainContainer">

        <header class="main-header">
            <h1>Fresh Market</h1>
            <i id="icon" class="fa-solid fa-bars"></i>
            <nav id="nav" class="nav">
                <a class="navlink" href="./index.php">Home</a>
                <a class="navlink active" href="./Products.php">Products</a>
                <a class="navlink" href="./Search.php">Search</a>
                <a class="navlink" href="./Cart.php">Cart</a>
                <a class="navlink" href="./Admin.php">Dashboard</a>
                <a class="navlink" href="./Login.php">Login | Register</a>
            </nav>
        </header>

        <section class="products-categoriesContainer" id="products-categories">
            <button>Fruits & Vegetables</button>
            <button>Groceries</button>
            <button>Snacks & Beverages</button>
        </section>

        <section class="products-container">
            <h2 id="Fruits&Vegetables">Fruits & Vegetables</h2>
            <div>
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i]["Category"] == "Fruits&Vegetables") {
                        displayLink($data[$i]);
                    }
                }
                ?>
            </div>
        </section>

        <section class="products-container">
            <h2 id="Groceries">Groceries</h2>
            <div>
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i]["Category"] == "Groceries") {
                        displayLink($data[$i]);
                    }
                }
                ?>
            </div>
        </section>

        <section class="products-container">
            <h2 id="Snacks&Beverages">Snacks & Beverages</h2>
            <div>
                <?php
                for ($i = 0; $i < count($data); $i++) {
                    if ($data[$i]["Category"] == "Snacks&Beverages") {
                        displayLink($data[$i]);
                    }
                }
                ?>
            </div>
        </section>
    </div>

</body>

</html>