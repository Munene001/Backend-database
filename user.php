<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$dbServername = "localhost";
$dbUsername = "lawrence";
$dbPassword = "Kikoto12.";
$dbName = "therapist";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$conn) {
    die('could not connect' . mysqli_connect_error());
}

if ( /*isset($_SERVER["REQUEST_METHOD"]) && */$_SERVER["REQUEST_METHOD"] == "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Construct the SQL query
    $sql = "INSERT INTO users (name, email, password)
    VALUES ('$name', '$email', '$password')";

// Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "users record created successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    if (empty($name)) {
        exit();

    }
    echo "this are the submitted data";

    header("Location: ../login.php");
} else {
    echo "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title>User signup</title>
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
        input[type="email"],
        input[type = "password"],
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
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: chocolate;
        }
.login{
    margin-top: 20px;
}

    </style>
</head>

<body>
    <h1>User Signup</h1>
    <form action="user.php" method="POST">
        <label for="name">Name</label>
        <input type="text" name="name" required><br>
        <label for="email">Email</label>
        <input type="text"  name="email" required><br>
        <label for="password">Password</label>
        <input type="password" name="password" required><br>


        <button type="Submit">SignUp</button>

        <div class = "login">Already have an account?<a href = "login.php">Login</a></div>
    </form>


</body>

</html>
