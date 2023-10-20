<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$dbServername = "localhost";
$dbUsername = "lawrence";
$dbPassword = "Kikoto12.";
$dbName = "therapist";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);
if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    if (isset($_GET["confirm"]) && $_GET["confirm"] === "true") {
        $query = "DELETE FROM therapist WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header("Location: ../table.php");
            exit();
        } else {
            die("SQL query failed: " . mysqli_error($conn));
        }
    } else {
        echo '<script>
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete.php?id=' . $id . '&confirm=true";
            }
            </script>';
        exit();
    }
} else {
    echo "Could not delete";
}
