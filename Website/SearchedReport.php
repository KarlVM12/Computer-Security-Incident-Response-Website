<!DOCTYPE html>
<html>
    <head>
        <title>Searched Report Request</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <p>Report #<?php echo $_POST["incidentID"]; ?></p>

        <?php 
            $servername = "localhost";
            $username = "root"; // Mysql username
            $password = "1234";	// Mysql Password

            $dbname = "csirts";	// database name
            
            // Create connection
            // MySQLi is Object-Oriented method
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("connection failed: " . $conn->connect_error ."<br>");
            } 
            
            $sql = "SELECT * FROM incident WHERE incidentID=" . $_POST["incidentID"] . "";
          
            $result = $conn->query($sql);
           
            if ($result->num_rows >  0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "incidentID: ". $row["incidentID"] . " - incidentType: " . $row["incidentType"] . 
                    " - creationDate: " . $row["creationDate"] . " - incidentState: " . $row["incidentState"] .
                    " - incidentName: " . $row["incidentName"] . " - handlerName: " . $row["handlerName"] . 
                    " - associationID: " . $row["associationID"] . "<br>";
                }
            } else {
                echo "0 results";
            }
        ?>

    </body>
</html>
        
