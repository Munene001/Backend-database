<?php
$dbServername = "localhost";
$dbUsername = "lawrence";
$dbPassword = "Kikoto12.";
$dbName = "therapist";

$conn = mysqli_connect("$dbServername", "$dbUsername", "$dbPassword", "$dbName");
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (!$conn) {
    die("Could  not connect:" . mysqli_error($conn));
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM therapist WHERE id = $id";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
} else {
    die("User ID not provided.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updatedfirstname = $_POST['first_name'];
    $updatedlastname = $_POST['last_name'];
    $updatedspeciality = $_POST['speciality'];
    $updatedgender = $_POST['gender'];
    $updatedcity = $_POST['city'];
    $updatedemail = $_POST['email'];

    $updatequery = "UPDATE therapist SET
        first_name = '$updatedFirstName',
        last_name = '$updatedLastName',
        speciality = '$updatedSpeciality',
        gender = '$updatedGender',
        city = '$updatedCity',
        email = '$updatedEmail'
        WHERE id = '$id'";

    $updateresult = mysqli_query($conn, $updatequery);
    if (!$updateResult) {
        die("Update failed: " . mysqli_error($conn));
    }

    // Redirect back to the table after successful update
    header("Location: ../table.php");
    exit();
}
