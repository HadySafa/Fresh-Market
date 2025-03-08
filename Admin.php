<?php


session_start();

if (isset($_SESSION["Id"])) {
    if ($_SESSION["Role"] != "Admin") {
        header("Location: ./Profile.php");
    }
} else {
    header("Location: ./Login.php");
}

require_once "./Backend/DatabaseHelper.php";

$query = "SELECT Id,Name FROM Products";
$connection = DatabaseHelper::createConnection();
try {
    $result = $connection->query($query);
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error occcured: " . $e->getMessage());
}

try {
    $query = "SELECT * FROM orders WHERE Status = 'Pending' ORDER BY Id DESC";
    $result = $connection->query($query);
    $pendingOrders = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error");
}

try {
    $query = "SELECT * FROM orders WHERE Status = 'Delivered' ORDER BY Id DESC";
    $result = $connection->query($query);
    $doneOrders = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error");
}

function displayOrder($data)
{
    $orderId = $data['Id'];
    $time = $data["Timestamp"];
    echo "
    <div class='order'>
        <div>
            <p>Order Id <span class='id'>$orderId</span></p>
            <p class='time'>$time</p>
        </div>
            <form method='post'><input type='hidden' name='OrderId' value='$orderId' /><button type='submit'>Deliver</button></form>
        </div>";
}

function displayDoneOrder($data)
{
    $orderId = $data['Id'];
    $time = $data["Timestamp"];
    echo "
    <div class='order'>
        <div>
            <p>Order Id <span class='id'>$orderId</span></p>
            <p class='time'>$time</p>
        </div>
            <p>Delivered</p>
        </div>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $query = "UPDATE orders SET Status='Delivered' WHERE Id = ?";
        $result = $connection->prepare($query);
        $result->execute([$_POST['OrderId']]);
        header('Location: ./Admin.php');
    } catch (PDOException $e) {
        die("Error");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./Styles/header.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
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
            <h2>Pending Orders <i class="fa-regular fa-clock"></i></h2>
            <div class="orders-container">
                <?php
                for ($i = 0; $i < count($pendingOrders); $i++) {
                    displayOrder($pendingOrders[$i]);
                }
                ?>
            </div>
        </section>

        <section class="orders-section" id="orders">
            <h2>Orders Done <i class="fa-solid fa-check"></i></h2>
            <div class="orders-container">
                <?php
                for ($i = 0; $i < count($doneOrders); $i++) {
                    displayDoneOrder($doneOrders[$i]);
                }
                ?>
            </div>
        </section>

        <section class="edit-quantity-section" id="editQuantity">
            <h2>Edit Item Quantity <i class="fa-regular fa-pen-to-square"></i></h2>
            <form action="./Backend/EditQuantity.php" id="edit-item-form" method="post">
                <label>
                    Select Item
                    <select name="Id" class="dropdown">
                        <option value="">Name</option>
                        <?php
                        for ($i = 0; $i < count($data); $i++) {
                            $id = $data[$i]['Id'];
                            $name = $data[$i]['Name'];
                            echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select>
                </label>
                <label>
                    Quantity $
                    <input class="input" name="Quantity" type="number">
                </label>
                <div class="error" id="edit-item-error-message"></div>
                <div class="buttons-container">
                    <button type="submit" class="input submit">Edit Quantity</button>
                </div>
            </form>
        </section>

        <section class="delete-item-section" id="deleteItem">
            <h2>Delete Item <i class="fa-solid fa-trash"></i></h2>
            <form action="./Backend/DeleteItem.php" id="delete-item-form" method="post">
                <label>
                    Select Item
                    <select name="Id" class="dropdown">
                        <option value="">Name</option>
                        <?php
                        for ($i = 0; $i < count($data); $i++) {
                            $id = $data[$i]['Id'];
                            $name = $data[$i]['Name'];
                            echo "<option value='$id'>$name</option>";
                        }
                        ?>
                    </select>
                </label>
                <div class="error" id="delete-item-error-message"></div>
                <div class="buttons-container">
                    <button type="submit" class="input submit delete">Delete</button>
                </div>
            </form>
        </section>

        <section class="new-item-section" id="newItem">
            <h2>New Item <i class="fa-solid fa-plus"></i></h2>
            <form action="./Backend/AddItem.php" id="new-item-form" method="post" enctype="multipart/form-data">
                <label>
                    Name
                    <input class="input" name="Name" type="text">
                </label>
                <label>
                    Description
                    <input class="input" name="Description" type="text">
                </label>
                <label>
                    Price $
                    <input class="input" step="any" name="Price" type="number">
                </label>
                <label>
                    Quantity
                    <input class="input" name="Quantity" type="number">
                </label>
                <label>
                    Category
                    <select name="Category" class="dropdown">
                        <option value="">Choose</option>
                        <option value="Fruits&Vegetables">Fruits & Vegetables</option>
                        <option value="Groceries">Groceries</option>
                        <option value="Snacks&Beverages">Snacks & Beverages</option>
                    </select>
                </label>
                <label>
                    Image
                    <input class="file-input" name="Image" type="file">
                </label>
                <div class="error" id="error-message"></div>
                <div class="buttons-container">
                    <button type="submit" class="input submit">Add Item</button>
                </div>
            </form>
        </section>

    </div>

</body>

</html>