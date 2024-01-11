<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$dbServername = "localhost";
$dbUsername = "lawrence";
$dbPassword = "root";
$dbName = "therapist";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die('could not connect' . mysqli_connect_error());
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $sql = " SELECT user_id FROM users WHERE email = '$email' AND  password = '$password'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        die('could not connect' . mysqli_connect_error());
    }

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['user_id'];
        echo '<script> alert("Login succesful. Redirecting....");
        window.location.href = "../index.php";</script>';
        exit();
    } else {

        header('location: ../login.php?error=invalid');
        exit();

    }

}
