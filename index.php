<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
        </style>
</head>

<body>
    <table>
        <tr>
            <th>User id</th>
            <th>First_name</th>
            <th>Last_name</th>
            <th>Speciality</th>
            <th>Gender</th>
            <th>City</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>

        <?php

$dbServername = "localhost";
$dbUsername = "lawrence";
$dbPassword = "Kikoto12.";
$dbName = "therapist";

// Create a database connection
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if (!$conn) {
    die('Could not connect: ' . mysqli_connect_error());
}

$query = "SELECT * FROM therapist";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['first_name'] . "</td>";
    echo "<td>" . $row['last_name'] . "</td>";
    echo "<td>" . $row['speciality'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['city'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";

    echo "</tr>";
}

// Close the database connection
mysqli_close($conn);
?>

    </table>

</body>

</html>