<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Login</title>
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="./Styles/forms.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="./Script/script.js"></script>
</head>

<body>
    <form action="Login.php" method="post" class="form" id="login-form">

        <h2>Login <i class="fa-solid fa-arrow-right-to-bracket"></i></h2>

        <label>
            Phone Number
            <input
                autofocus
                type="number"
                name="PhoneNumber"
                id="PhoneNumber"
                placeholder="8-digit number"
                class="input" />
        </label>

        <label>
            Password
            <input
                type="password"
                name="Password"
                id="Password"
                placeholder="********"
                class="input" />
        </label>

        <div class="buttons-container">
            <button type="reset" class="button">Cancel</button>
            <button type="submit" class="button submit">Login</button>
        </div>

    </form>
</body>

</html>

<?php

require_once './Backend/DatabaseHelper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!empty($_POST["PhoneNumber"]) && !empty($_POST["Password"])) {

        $query = "SELECT * FROM Users where PhoneNumber = ?";
        $connection = DatabaseHelper::createConnection();
        try {
            $result = $connection->prepare($query);
            $result->execute([$_POST["PhoneNumber"]]);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);
            $password = $data[0]["Password"];
            if (password_verify($_POST["Password"], $password)) {
                if ($data[0]["Role"] == "User") {
                    session_start();
                    $_SESSION["Role"] = "User";
                    $_SESSION["PhoneNumber"] = $_POST["PhoneNumber"];
                    $_SESSION["Id"] = $data[0]["Id"];
                    header("Location: ./Profile.php");
                    exit();
                } else {
                    session_start();
                    $_SESSION["Role"] = "Admin";
                    $_SESSION["PhoneNumber"] = $_POST["PhoneNumber"];
                    $_SESSION["Id"] = $data[0]["Id"];
                    header("Location: ./Admin.php");
                    exit();
                }
            }
        } catch (PDOException $e) {
            die("Error occcured: " . $e->getMessage());
        }
    }
}


?>