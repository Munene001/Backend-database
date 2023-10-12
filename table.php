<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <title>Document</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        background-color: #dcdcdc;
        font-size: 15px;
    }

    .container {
        width: 85%;
        margin: 15% auto 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid #ddd;
        font-family: "Open Sans", Arial, sans-serif;
        background-color: white;
    }

    th,
    td {
        border: 1px solid black;
        height: 50px;
        text-align: left;
        padding-left: 5px;
        padding-bottom: 5px;
    }

    tr:nth-child(even) {
        background-color: #d2d2d2;
    }

    .buttons {
        width: 100%;
        margin: 15% auto 0;
        display: flex;
        flex-direction: row;
        margin-bottom: 5px;
    }

    .button {
        border-radius: 7px;
        font-size: 16px;
        padding: 10px;
        margin-left: 4px;
    }

    .edit {
        background-color: chocolate;
    }

    .create {
        background-color: gray;
    }

    .delete {
        background-color: yellow;
    }

    .action-icons {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: start;

    }

    .action-icons button i {
        cursor: pointer;
        font-size: 20px;


    }
    .action-icons button i.fa-edit{
        color: brown;


    }
    .action-icons button i.fa-trash-alt{
        color: red;



    }
  </style>
</head>

<body>
    <div class="container">
        <div class="buttons">
            <button class="button edit">Edit</button>
            <button class="button create">Create</button>
            <button class="button delete">Delete</button>
        </div>
        <table>
            <tr>
                <th>User Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
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

$conn = mysqli_connect("$dbServername", "$dbUsername", "$dbPassword", "$dbName");

if (!$conn) {
    die("Could not connect: " . mysqli_error($conn));
}

$query = "SELECT * FROM therapist";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Could not connect: " . mysqli_error($conn));
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
    echo '<td class="action-icons">
    <button><a href="change.php?id=' . $row['id'] . '"><i class="fas fa-edit" title="Edit"></i></a></button>




                            <button><i class="fas fa-trash-alt" title = "Delete"></i></button>

                          </td>';

    echo "</tr>";
}
?>
        </table>
    </div>
</body>

</html>