<?php

require_once './Backend/DatabaseHelper.php';
session_start();

if (isset($_SESSION["Id"])) {
    if (isset($_SESSION["Products"])) {
        $userId = $_SESSION['Id'];
    } else {
        header("Location: Cart.php");
    }
} else {
    header("Location: ./Login.php");
}

$connection = DatabaseHelper::createConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $locationDescription = $_POST["Location"];
    $paymentMethod = $_POST["PaymentMethod"];
    $query = "INSERT INTO orders(UserId,PaymentMethod,Status,Location,TimeStamp) VALUES (?,?,?,?,?)";
    $result = $connection->prepare($query);
    $result->execute([$userId, $paymentMethod, "Pending", $locationDescription, getDateTime()]);
    $orderId = $connection->lastInsertId();
    if ($orderId) {
        for ($i = 0; $i < count($_SESSION["Products"]); $i++) {
            $query = "INSERT INTO transaction(Quantity,ProductId,OrderId) VALUES (?,?,?)";
            $result = $connection->prepare($query);
            $productId = $_SESSION['Products'][$i];
            $quantity = $_SESSION['Quantities'][$productId];
            $result->execute([$quantity, $productId, $orderId]);
            $query = "UPDATE products SET Quantity = Quantity - ? WHERE Id = ?";
            $result = $connection->prepare($query);
            $result->execute([$quantity, $productId]);
        }
        unset($_SESSION['Products']);
        unset($_SESSION['Quantities']);
        header('Location: ./Profile.php');
    }
}

function getDateTime()
{
    $date = new DateTime('now', new DateTimeZone('UTC'));
    $isoDate = $date->format('c');
    return $isoDate;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Checkout</title>
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="./Styles/cart.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="./Script/script.js"></script>
</head>

<body>

    <form method="POST" id="checkout-form" class="form">
        <h2>Checkout</h2>
        <label>
            Location
            <input name="Location" type="text" class="input">
        </label>
        <label>
            Payment Method
            <select name="PaymentMethod" class="dropdown">
                <option value="">-- Choose --</option>
                <option value="cod">Cash On Delivery</option>
                <option value="check">Check</option>
            </select>
        </label>
        <div id="checkout-error-message" class="error"></div>
        <button class="submit" type="submit">Confirm Order</button>
    </form>

</body>

</html>