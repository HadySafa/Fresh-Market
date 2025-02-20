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
            <table class="table">
                <tr class="header">
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Computed Price $</th>
                    <th>Remove</th>
                </tr>
                <tr class="row">
                    <td>Mint</td>
                    <td>8</td>
                    <td>455</td>
                    <td><i class="fa-solid fa-trash delete"></i></td>
                </tr>
                <tr class="row">
                    <td>Mint</td>
                    <td>8</td>
                    <td>455</td>
                    <td><i class="fa-solid fa-trash delete"></i></td>
                </tr>
                <tr class="row">
                    <td>Mint</td>
                    <td>8</td>
                    <td>455</td>
                    <td><i class="fa-solid fa-trash delete"></i></td>
                </tr>
            </table>
            <div class="subContainer">
                <p>Total <span class="price">$455</span></p>
                <a href="./Checkout.php">Checkout</a>
            </div>
        </div>
    </div>

</body>

</html>