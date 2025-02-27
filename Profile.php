<?php

function displayOrder($data)
{
    $orderId = $data['Id'];
    $status = $data["Status"];
    $time = $data["Timestamp"];
    echo "
    <div class='order'>
        <div>
            <p>Order Id <span class='id'>$orderId</span></p>
            <p class='time'>$time</p>
        </div>
            <p>$status</p>
        </div>";
}

session_start();
require_once "./Backend/DatabaseHelper.php";
$connection = DatabaseHelper::createConnection();

if (isset($_SESSION["Id"])) {
    if ($_SESSION["Role"] != "User") {
        header("Location: ./Admin.php");
    }
} else {
    header("Location: ./Login.php");
}

try {
    $query = "SELECT * FROM orders WHERE UserId = ?";
    $result = $connection->prepare($query);
    $result->execute([$_SESSION['Id']]);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Feedback"]) && !empty($_POST["Feedback"])) {
        $feedback = $_POST["Feedback"];
        try {
            $query = "INSERT INTO reviews (Description,UserId) VALUES (?, ?)";
            $result = $connection->prepare($query);
            $result->execute([$feedback, $_SESSION['Id']]);
        } catch (PDOException $e) {
            die("Error");
        }
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
            <?php if ($data) { ?>
                <div class="orders-container">
                    <?php
                        for($i=0;$i<count($data);$i++){
                            displayOrder($data[$i]);
                        }
                    ?>
                </div>
            <?php } ?>

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