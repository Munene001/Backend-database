<?php
session_start();
if (isset($_GET['error']) && $_GET['error'] === 'invalid') {
    echo '<script> alert("Invalid email or password");</script>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title>User Login</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        background-color: brown;
        color: white;
        padding: 10px;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    select {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        padding: 8px;
    }

    button[type="submit"] {
        background-color: brown;
        color: white;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
        cursor: pointer;
    }

    button[type="submit"]:hover {
        background-color: chocolate;
    }

    .signup {
        margin-top: 20px;

    }
    </style>
</head>

<body>
    <h1>User login</h1>
    <form action="connect/login_handler.php" method="POST">
        <div id = "messageBox"></div>
        <label for="email">Email</label>
        <input type="text" name="email" required placeholder="Enter Email"> <br>
        <label for="password">Password</label>
        <input type="password" name="password" required placeholder="Enter Password"><br>


        <button type="submit">Login</button>

        <div class="signup">Dont have an account?<a href="user.php">Signup</a></div>

    </form>

</body>

</html>
