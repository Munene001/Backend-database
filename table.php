<?php
session_start();

// Check if the user is not logged in. If not, redirect to the login page.
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

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

        th, td {
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

        .export {
            background-color: palevioletred;
            margin-bottom: 5px;
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

        .action-icons button i.fa-edit {
            color: brown;
        }

        .action-icons button i.fa-trash-alt {
            color: red;
        }

        .search-wrapper {
            display: flex;
            flex-direction: column;
            justify-content: start;
        }

        .search {
            border-radius: 7px;
            margin-right: 43em;
            background-color: chocolate;
        }

        .search-wrapper input[type="text"] {
            padding: 7px;
        }

        .lower {
            display: flex;
            flex-direction: row;
        }

        .upper {
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .export-options {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="buttons">
            <div class="search-wrapper">
                <div class="middle">
                    <button class=" button export" onclick="ExportOptions()">Export</button>
                    <div class="export-options">
                        <button class="export-option" onclick="exportData('CSV')">CSV</button>
                        <button class="export-option" onclick="exportData('PDF')">PDF</button>
                        <button class="export-option" onclick="exportData('Excel')">Excel</button>
                    </div>
                </div>

                <div class="upper">
                    <input type="text" id="searchinput" placeholder="Search..">
                    <button class="button search" onclick="searchtable()">Search</button>
                    <button class="button create"><a href="create_therapist.php">Create</a></button>
                </div>
            </div>
        </div>
        <table id="example">
            <thead>
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
            </thead>
            <tbody>
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
                            <button><a href="delete.php?id=' . $row['id'] . '"><i class="fas fa-trash-alt" title="Delete"></i></a></button>
                        </td>';
    echo "</tr>";
}
?>
            </tbody>
        </table>
    </div>
    <script>
        function searchtable() {
            let input = document.getElementById('searchinput').value;
            input = input.toLowerCase();
            let tr = document.querySelectorAll('table tr');
            for (let i = 1; i < tr.length; i++) {
                let td = tr[i].getElementsByTagName('td');
                let rowMatches = false;
                for (let j = 0; j < td.length; j++) {
                    let cellText = td[j].textContent || td[j].innerText;
                    cellText = cellText.toLowerCase();
                    if (cellText.includes(input)) {
                        rowMatches = true;
                        break;
                    }
                }
                if (rowMatches) {
                    tr[i].style.display = '';
                } else {
                    tr[i].style.display = 'none';
                }
            }
        }

        function ExportOptions() {
            $('#example').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'csv',
                        text: 'CSV',
                        action: function (e, dt, button, config) {
                            exportData('CSV');
                        }
                    },
                    {
                        extend: 'excel',
                        text: 'Excel',
                        action: function (e, dt, button, config) {
                            exportData('Excel');
                        }
                    },
                    {
                        extend: 'pdf',
                        text: 'PDF',
                        action: function (e, dt, button, config) {
                            exportData('PDF');
                        }
                    }
                ],
                buttonContainer: {
                    align: 'button-left'
                }
            });
        }

        function exportData(format) {
            if (format === "CSV") {
                alert("Exporting via CSV");
            } else if (format === "PDF") {
                alert("Exporting via PDF");
            } else if (format === "Excel") {
                alert("Exporting via Excel");
            }
        }
    </script>
</body>

</html>
