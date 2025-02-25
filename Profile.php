<?php

session_start();

if(isset($_SESSION["Id"])){
    if( $_SESSION["Role"] != "User"){
        header("Location: ./Admin.php");
    }
}
else{
    header("Location: ./Login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["Feedback"]) && !empty($_POST["Feedback"])){
        $feedback = $_POST["Feedback"];
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Styles/header.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="./Styles/profiles.css" />
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
                <a class="navlink" href="./Cart.php">Cart</a>
                <a class="navlink active" href="./Admin.php">Dashboard</a>
                <a class="navlink" href="./Login.php">Login | Register</a>
            </nav>
        </header>

        <section class="orders-section" id="orders">
            <h2>Orders Done <i class="fa-solid fa-check"></i></h2>
            <div class="orders-container">
                <div class="order">
                    <div>
                        <p>Order Id <span class="id">7885</span></p>
                        <p>February 12, 2025, 2:30 pm</p>
                    </div>
                    <p>Pending</p>
                </div>
                <div class="order">
                    <div>
                        <p>Order Id <span class="id">7885</span></p>
                        <p>February 12, 2025, 2:30 pm</p>
                    </div>
                    <p>Delivered</p>
                </div>
            </div>
        </section>

        <form method="post" action="Profile.php" class="feedback-form" id="feedback-form">
            <h2>Give Your Feedback</h2>
            <input class="input" type="text" name="Feedback">
            <div class="error" id="feedbackError"></div>
            <button class="input submit" type="submit">Submit</button>
        </form>


    </div>

</body>

</html>