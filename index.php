<?php

require_once './Backend/DatabaseHelper.php';

try {
    $query = 'SELECT * FROM reviews NATURAL JOIN (SELECT ID AS UserID,Name FROM users) AS users';
    $connection = DatabaseHelper::createConnection();
    $result = $connection->query($query);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOEXCEPTION $e) {
    // handle error
}

function displayReview($data){
    $name = $data["Name"];
    $description = $data["Description"];
    echo "
         <div class='review'>
            <p>$description</p>
            <p>- $name</p>
        </div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market</title>
    <link rel="stylesheet" href="./Styles/style.css" />
    <link rel="stylesheet" href="./Styles/header.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="./Script/script.js"></script>
</head>

<body>

    <div class="home-mainContainer">

        <header class="main-header">
            <h1>Fresh Market</h1>
            <i id="icon" class="fa-solid fa-bars"></i>
            <nav id="nav" class="nav">
                <a class="navlink active" href="./index.php">Home</a>
                <a class="navlink" href="./Products.php">Products</a>
                <a class="navlink" href="./Search.php">Search</a>
                <a class="navlink" href="./Cart.php">Cart</a>
                <a class="navlink" href="./Admin.php">Dashboard</a>
                <a class="navlink" href="./Login.php">Login | Register</a>
            </nav>
        </header>

        <section id="AboutUs" class="about-section">
            <div>
                <h2>About Us</h2>
                <p class="about-description">Welcome to Fresh Market – Your 24/7 Grocery Destination in Beirut, Lebanon!
                    🌿<br />

                    At Fresh Market, we take pride in offering a wide range of high-quality products, including fresh
                    fruits, vegetables, snacks, canned goods, and much more. Whether you're shopping for everyday
                    essentials or something special, we've got you covered.<br />

                    With a commitment to quality and convenience, we're here for you around the clock, day or night.
                    Visit us anytime and experience the best in freshness and service.<br />

                    Your grocery needs, anytime you need them.<br />

                </p>
                <div class="links-container">
                    <div class="link"><i class="fa-brands fa-whatsapp"></i></div>
                    <div class="link"><i class="fa-solid fa-phone"></i></div>
                    <div class="link"><i class="fa-brands fa-instagram"></i></div>
                </div>
            </div>
            <div>
                <img class="home-mainImage" src="./Images/shop.png" alt="Grocery Shop" loading="lazy" />
            </div>
        </section>

        <section id="OurProducts" class="productCategories-container">
            <h2>Products</h2>
            <div>
                <div class="product-category">
                    <a href="./Products.php#Fruits&Vegetables"><h4>Fruits and Vegetables</h4></a>
                </div>
                <div class="product-category">
                    <a href="./Products.php#Groceries"><h4>Groceries</h4></a>
                </div>
                <div class="product-category">
                    <a href="./Products.php#Snacks&Beverages"><h4>Snacks and Beverages</h4></a>
                </div>
            </div>
        </section>

        <section id="Location" class="MapContainer">
            <h2>Our Location</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26772.13669949315!2d35.5042823!3d33.889218299999996!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f17215880a78f%3A0x729182bae99836b4!2sBeirut!5e1!3m2!1sen!2slb!4v1739046068808!5m2!1sen!2slb"
                width="100%" height="100%" style="border: 0; border-radius: 5px;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

        <section class="customersFeedback-Container" id="CustomersFeedback">
            <h2>Customers Feedback <i class="fa-regular fa-comment"></i></h2>
            <div>
                <?php
                $max = count($data) > 4 ? 4 : count($data);
                for($i = 0; $i < $max; $i++){
                    displayReview($data[$i]);
                }
                ?>
            </div>
        </section>

    </div>

</body>

</html>