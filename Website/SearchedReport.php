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

            $dbname = "csirt";	// database name
            
            // Create connection
            // MySQLi is Object-Oriented method
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("connection failed: " . $conn->connect_error ."<br>");
            } 
            
            // Prints complete Incident
            $sql1 = "SELECT * FROM incident WHERE incidentID=" . $_POST["incidentID"] . "";
          
            $result1 = $conn->query($sql1);
           
            if ($result1->num_rows >  0) {
                // output data of each row
                while($row = $result1->fetch_assoc()) {
                    echo "incidentID: ". $row["incidentID"] . " - incidentType: " . $row["incidentType"] . 
                    " - creationDate: " . $row["creationDate"] . " - incidentState: " . $row["incidentState"] .
                    " - incidentName: " . $row["incidentName"] . " - handlerName: " . $row["handlerName"] . 
                    " - associationID: " . $row["associationID"] . "<br>";
                }
            } else {
                echo "0 results";
            }

            // Prints comments from incident
            $sql2 = "SELECT * FROM comment WHERE incidentID=" . $_POST["incidentID"] . " ORDER BY commentDate DESC";
          
            $result2 = $conn->query($sql2);
           
            if ($result2->num_rows >  0) {
                // output data of each row
                while($row = $result2->fetch_assoc()) {
                    echo "commentID: ". $row["commentID"] . " - incidentID: " . $row["incidentID"] . 
                    " - commentDescription: " . $row["commentDescription"] . " - commentDate: " . $row["commentDate"] .
                    " - handlerName: " . $row["handlerName"] . "<br>";
                }
            } else {
                echo "0 results";
            }

            $conn->close();
        ?>
        
        <form action="IncidentReports.html"> 
            <input type="submit" value="Go Back to Main Page"><br>
        </form>
    </body>
</html>
        
