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

    $target_dir = "/var/www/html/uploads/" . $id . "/";
    $target_file = $target_dir . basename($_FILES["filesToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if (isset($_POST["submit"])) {
        $check = getimagesize($FILES["fileToUpload"]["tmp_name"]);
        if ($check === false) {
            echo "file is not an image";
            $uploadOk = 1;
        } else {
            echo "file is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        }
    }
    if (file_exists($target_file)) {
        echo "Sorry,file already exists.";
        $uploadOk = 0;
    }
    if ($FILES["fileToUplaod"]["size"] > 500000) {
        echo "Sorry,your file is too large";
        $uploadOk = 0;
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry,only jpg,png,jpeg and gif files are allowed";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $updatequery = "UPDATE therapist SET
    first_name = '$updatedfirstname',
    last_name = '$updatedlastname',
    speciality = '$updatedspeciality',
    gender = '$updatedgender',
    city = '$updatedcity',
    email = '$updatedemail'
    WHERE id = $id";

    $updateresult = mysqli_query($conn, $updatequery);
    if (!$updateresult) {
        die("Update failed: " . mysqli_error($conn));
    }

    // Redirect back to the table after successful update
    header("Location: ../table.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <title>Edit Therapist</title>
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
        background-color: #0056b3;
    }
    </style>
</head>

<body>
    <h1>Edit Therapist</h1>
    <form action="change.php?id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data">
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" required><br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" required><br>
        <label for="speciality">Speciality</label>
        <input type="text" name="speciality" required><br>
        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label for="city">City</label>
        <select name="city" required>
            <option value="Nairobi">Nairobi</option>
            <option value="Nakuru">Nakuru</option>
            <option value="Kisumu">Kisumu</option>
            <option value="Mombasa">Mombasa</option>
            <option value="Eldoret">Eldoret</option>
        </select><br>

        <label for="email">Email</label>
        <input type="text" name="email" required><br>

        <label for="fileToUpload">ProfilePicture</label>
        <input type="file" name="fileToUpload" accept="image/*"><br>

        <button type="submit">Edit Therapist</button>
    </form>
</body>

</html>