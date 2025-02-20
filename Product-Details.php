<?php
require_once "./Backend/DatabaseHelper.php";

$query = "SELECT * FROM Products where Id = ?";
$connection = DatabaseHelper::createConnection();
try {
    $result = $connection->prepare($query);
    $result->execute([$_GET["Id"]]);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error occcured: " . $e->getMessage());
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
        echo "
        <div class='image-container'><img src='$imageSrc' class='Product Image'></div>

        <div class='details'>
            <div class='row1'>
                <h4>$name</h4>
                <p>$ $price</p>
            </div>
            <div class='row2'>
                <p>$desc</p>
            </div>
            <div class='row3'>
                <button id='minus'><i class='fa-solid fa-minus'></i></button><input type='number' value='1' max='$quantity' min='1' data-maxQuantity='$quantity'><button id='plus'><i class='fa-solid fa-plus'></i></button>
            </div>
            <div class='row4'>
                <button>Add To Cart</button>
            </div>
        </div>";

        ?>

    </section>
</body>

</html>