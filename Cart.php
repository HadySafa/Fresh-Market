<?php

session_start();
require_once "./Backend/DatabaseHelper.php";
$connection = DatabaseHelper::createConnection();

if (!isset($_SESSION["Id"]) || empty($_SESSION["Id"])) {
    header("Location: Login.php");
}

$totalPrice;
function displayTableRow($data,$quantity){
    $productName = $data['Name'];
    $computedPrice = $data['Price'] * $quantity;
    $totalPrice += $computedPrice;
    echo "
    <tr class='row'>
    <td>$productName</td>
    <td>$quantity</td>
    <td>$computedPrice</td>
    <td><i class='fa-solid fa-trash delete'></i></td>
    </tr>" ;
}

function displayTotalPrice(){
    echo($totalPrice);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Cart</title>
    <link rel="stylesheet" href="./Styles/header.css" />
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="./Styles/cart.css" />
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
                <a class="navlink" href="./Products.php">Products</a>
                <a class="navlink" href="./Search.php">Search</a>
                <a class="navlink active" href="./Cart.php">Cart</a>
                <a class="navlink" href="./Admin.php">Dashboard</a>
                <a class="navlink" href="./Login.php">Login | Register</a>
            </nav>
        </header>
        <div>
            <?php
                if(isset($_SESSION["Products"])){
                    echo "<table class='table'>";
                    echo "<tr class='header'>
                          <th>Item Name</th>
                          <th>Quantity</th>
                          <th>Computed Price $</th>
                          <th>Remove</th>
                          </tr>";
                    for($i=0 ; $i < count($_SESSION["Products"]); $i++){
                        $productId = $_SESSION["Products"][$i];
                        try {
                            $query = "SELECT * FROM Products where Id = ?";
                            $result = $connection->prepare($query);
                            $result->execute([$productId]);
                            $data = $result->fetchAll(PDO::FETCH_ASSOC);
                            displayTableRow($data[0],$_SESSION['Quantities'][$productId]);
                        } catch (PDOException $e) {
                            die("Error occcured: " . $e->getMessage());
                        }
                    }
                    echo "</table>";
                }
                else{
                    echo "No Products Added To Cart";
                }
            ?>
            <div class="subContainer">
                <p>Total <span class="price">$455</span></p>
                <a href="./Checkout.php">Checkout</a>
            </div>
        </div>
    </div>

</body>

</html>