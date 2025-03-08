<?php

require_once './Backend/DatabaseHelper.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (!empty($_POST["FullName"]) && !empty($_POST["PhoneNumber"]) && !empty($_POST["Email"]) && !empty($_POST["Password"]) && !empty($_POST["ConfirmPassword"])) {

        $data = validateInput($_POST);
    
        if ($data) {
            $connection = DatabaseHelper::createConnection();
            $query = "INSERT INTO users (Name, Email, PhoneNumber, Password ,Role) VALUES (?, ?, ?, ?, ?)";
            $result = $connection->prepare($query);
            $result->execute([$data["FullName"], $data["Email"], $data["PhoneNumber"], $data["Password"], "User"]);
            $userId = $connection->lastInsertId();
            if($userId){
                header("Location: ./Login.php");
                exit();
            }
        } else {
            // handle error: wrong data entry
        }
    } else {
        // handle error: all fields are required
    }
}

function validateInput($array){
    if (is_numeric($array["PhoneNumber"]) && strlen($array["PhoneNumber"]) == 8) {
        if (filter_var($array["Email"], FILTER_VALIDATE_EMAIL)) {
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
            if (preg_match($pattern, $array["Password"])) {
                if ($array["Password"] == $array["ConfirmPassword"]) {
                    $array["Password"] = hashPassword($array["Password"]);
                    return $array;
                }
            }
        }
    }
    return null;
}

function hashPassword($password){
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedPassword;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fresh Market | Sign Up</title>
    <link rel="icon" href="./Images/shop-solid.svg" type="image/x-icon">
    <link rel="stylesheet" href="./Styles/forms.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="./Script/script.js"></script>
</head>

<body>
    <form action="SignUp.php" method="post" class="form" id="signup-form">

        <h2>Sign Up <i class="fa-solid fa-user-plus"></i></h2>

        <label>
            Full Name
            <input
                autofocus
                type="text"
                name="FullName"
                id="FullName"
                class="input" />
        </label>

        <label>
            Phone Number
            <input
                type="number"
                name="PhoneNumber"
                id="PhoneNumber"
                placeholder="8-digit number"
                class="input" />
            <div id="numberError" class="error-message"></div>
        </label>

        <label>
            Email
            <input
                type="text"
                name="Email"
                id="Email"
                placeholder="user@example.com"
                class="input" />
            <div id="emailError" class="error-message"></div>
        </label>

        <label>
            Password
            <input
                type="password"
                name="Password"
                id="Password"
                placeholder="********"
                class="input" />
            <div id="passwordError" class="error-message"></div>
        </label>

        <label>
            Confirm Password
            <input
                type="password"
                name="ConfirmPassword"
                id="ConfirmPassword"
                placeholder="********"
                class="input" />
            <div id="confirmPasswordError" class="error-message"></div>
        </label>

        <div id="general-error" class="error-message"></div>

        <div class="buttons-container">
            <button type="reset" class="button">Cancel</button>
            <button type="submit" class="button submit">Sign Up</button>
        </div>

    </form>
</body>

</html>

