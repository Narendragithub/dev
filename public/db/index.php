<?php
   $dbhost = 'phpmyadmin.c67m8wqberfz.us-east-2.rds.amazonaws.com';
   $dbuser = 'cubedots123';
   $dbpass = 'cubedots123';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass);
   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   echo 'Connected successfully';
   mysql_close($conn);

   /*$dbhost = 'phpmyadmin.c67m8wqberfz.us-east-2.rds.amazonaws.com';
   $dbuser = 'cubedots123';
   $dbpass = 'cubedots123';
   $dbname = 'dev_db';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   if(! $conn )
   {
     die('Could not connect to instance: ' . mysqli_error($conn));
   }
   echo 'Connected to MySQL Successfully!';
   $sql = "SELECT id, firstname, lastname FROM users";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
    }
} else {
    echo "0 results";
}

$sql = "UPDATE users SET lastname='Doe' WHERE id=47";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();*/
?>