<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/result.css">
    <title>Result</title>
</head>
<body>
    
<script src="/js/main.js"></script>
<?php 

$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "lottery";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the row where count is 3
$delete_query1 = "DELETE FROM entries
WHERE (Email, Name, Address, Phone) IN (
    SELECT Email, Name, Address, Phone
    FROM entries
    GROUP BY Email, Name, Address, Phone
    HAVING COUNT(*) = 3
);";
if ($conn->query($delete_query1) === TRUE) {
    //echo "Row deleted successfully.";
} else {
    echo "Error deleting row: " . $conn->error;
}
// Delete 2 entries where count is 5
$delete_query2 = "DELETE FROM entries
WHERE (Email, Name, Address, Phone) IN (
    SELECT Email, Name, Address, Phone
    FROM entries
    GROUP BY Email, Name, Address, Phone
    HAVING COUNT(*) = 5
)
LIMIT 2;";
if ($conn->query($delete_query2) === TRUE) {
    //echo "2 Rows deleted successfully.";
} else {
    echo "Error deleting rows: " . $conn->error;
}

// Select a random entry from the remaining table
$select_query = "SELECT * FROM entries ORDER BY RAND() LIMIT 1";
$result = $conn->query($select_query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo "<div class='congrats'><h1>Congratulations! " . $row['Name']."</h1></div>";
} else {
    echo "No remaining rows in the table.";
}
$conn->close();




?>

</body>
</html>