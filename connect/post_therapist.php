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

    $first_name = htmlspecialchars($_POST["first_name"]);
    $last_name = htmlspecialchars($_POST["last_name"]);
    $speciality = htmlspecialchars($_POST["speciality"]);
    $gender = htmlspecialchars($_POST["gender"]);
    $city = htmlspecialchars($_POST["city"]);
    $email = htmlspecialchars($_POST["email"]);

    // Construct the SQL query
    $sql = "INSERT INTO therapist (first_name, last_name, speciality, gender, city, email)
    VALUES ('$first_name', '$last_name', '$speciality', '$gender', '$city', '$email')";

// Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Therapist record created successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    if (empty($first_name)) {
        exit();

    }

    echo "this are the submitted data";

    header("Location: ../index.php");
} else {
    echo "when";
}
