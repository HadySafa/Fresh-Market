<?php

require_once './Backend/DatabaseHelper.php';

$data = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $connection = DatabaseHelper::createConnection();

    if (isset($_POST["SearchParameter"]) && !empty($_POST["SearchParameter"])) {
        $searchParameter = $_POST["SearchParameter"];
        $query = "SELECT * FROM Products WHERE Name LIKE '%$searchParameter%'";

        try {
            $result = $connection->query($query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error occcured: " . $e->getMessage());
        }
    }
}

function returnLink($data)
{
    $image = $data["Image"];
    $name = $data["Name"];
    $id = $data["Id"];
    echo "
            <a href='./Product-Details.php?Id=$id' class='product'><img src='$image' alt=''>
            <p>$name</p><i class='fa-solid fa-arrow-right'></i>
            </a>
         ";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Search Products</title>
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="./Styles/search.css" />
    <link rel="stylesheet" href="./Styles/header.css" />

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
                <a class="navlink active" href="./Search.php">Search</a>
                <a class="navlink" href="./Cart.php">Cart</a>
                <a class="navlink" href="./Admin.php">Dashboard</a>
                <a class="navlink" href="./Login.php">Login | Register</a>
            </nav>
        </header>

        <form method="post" action="Search.php" class="form">
            <h2>Search in products</h2>

            <div>
                <input autofocus class="input" type="text" name="SearchParameter">
                <button class="submit" type="submit">Search</button>
            </div>
        </form>

        <?php

        if (count($data) > 0) {
            echo "<div class='results'>";
            echo "<h4>Search results for '$searchParameter'</h4>";
            for ($i = 0; $i < count($data); $i++) {
                returnLink($data[$i]);
            }
            echo "</div>";
        }
        else{
            echo "<div>No Results<div>";
        }


        ?>

    </div>

</body>

</html>