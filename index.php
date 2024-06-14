<?php

$servername="localhost";
$username="root";
$password="";

// Create a connection to the database
$conn=new mysqli($servername,$username,$password);

// Check connection
if($conn->connect_error){
	die("Connection Failed " . $conn->connect_error);
}else{
	echo "Connected Successfully";
}

// Create the database Noor
$sql_create_db= "CREATE DATABASE IF NOT EXISTS Noor DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci";
if ($conn->query($sql_create_db) === TRUE) {
    echo "The noor database has been created successfully.<br>";
} else {
    echo "An error occurred while creating the database: " . $conn->error . "<br>";
}

//Choose database Noor
$conn->select_db("Noor");


//Create a table Bay
$sql_create_table="CREATE TABLE IF NOT EXISTS Noo (
    id INT(3) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,
    avg INT NOT NULL
)";

if ($conn->query($sql_create_table) === TRUE) {
    echo "Table Noo was created successfully.<br>";
} else {
    echo "An error occurred while creating the table: " . $conn->error . "<br>";
}


// The record data that we will enter
$records = array(
    array("1", "Noor", 69),
    array("2", "Majdy", 00),
    array("3", "Sakhel", 02)
);


// Insert records into the table
foreach ($records as $record) {
    $sql = "INSERT INTO Noo (name, avg) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $record[1], $record[2]);

    if ($stmt->execute() === TRUE) {
        echo "The record was entered successfully.<br>";
    } else {
        echo "An error occurred while entering the log: " . $conn->error . "<br>";
    }

    $stmt->close();
}


// SQL query to retrieve records
$sql = "SELECT * FROM Noo";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
   // Display the data in an appropriate way
    echo "<table border='1'>";
    echo "<tr><th>Id</th><th>name</th><th>avg</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["avg"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records available.";
}

// SQL query to delete the record
$sql = "DELETE FROM Noo WHERE id={$records[2][0]}";

if ($conn->query($sql) === TRUE) {
	echo "The record has been deleted successfully.<br>";
} else {
	echo "An error occurred while deleting the record: " . $conn->error;
}


// SQL query to modify the value of the avg column
$sql = "UPDATE Noo SET avg = 12 WHERE id = {$records[0][0]}";

if ($conn->query($sql) === TRUE) {
    echo "The rate value has been modified successfully.<br>";
} else {
    echo "An error occurred while modifying the rate value: " . $conn->error;
}
mysqli_close($conn);