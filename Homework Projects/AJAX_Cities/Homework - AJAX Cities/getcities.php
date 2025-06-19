<?php
//reference: W3Schools and Class Notes

//get the state from GET
$state = $_GET['state'];

//connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ajax_demo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//query the database for cities
$sql = "SELECT city_name FROM cities WHERE state_name='$state'";
$result = $conn->query($sql);

//if the city exists, put it in a drop down menu
if ($result->num_rows > 0) {
  echo "<select name='city'>\n";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<option>" . $row["city_name"]. "</option>\n";
  }
  echo "</select>\n";
} else { //otherwise display error message
    echo "Invalid information: please go <a href=index.html> here </a>.";
    exit;
}

//close database connection
$conn->close();