<!DOCTYPE html>
<html>
    <head>
        <title>Searched Report Request</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <p>Incident Report</p>

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
            
            // Prints complete Incident // ------------------------------------------------------
            $sql1 = "SELECT * FROM incident WHERE incidentID=" . $_POST["incidentID"] . "";
          
            $result1 = $conn->query($sql1);
           
            if ($result1->num_rows >  0) {
                // output data of each row
                while($row = $result1->fetch_assoc()) {
                    echo "<h3>Incident ID # </h3>".$_POST["incidentID"]."<br>". 
                    "Incident Created on: ".$row["creationDate"]."<br>". 
                    "Reason for Incident: ".$row["incidentType"]."<br>". 
                    "Incident Description: ".$row["incidentName"]."<br>". 
                    "State of the Incident: ".$row["incidentState"]."<br>". 
                    "Currently Being Handled By: ".$row["handlerName"]."<br><br>";
                }
            } else {
                echo "<h3>No Incident With this ID</h3>";
            }

            // People Involved // ---------------------------------------------------------------
            $sqlpeople = "select * from incident join involvedperson on incident.incidentID=involvedperson.incidentid join person on person.associationID = involvedperson.associationID where incident.incidentid =".$_POST["incidentID"];
            $resultspeople = $conn->query($sqlpeople);
            
            if ($resultspeople->num_rows >  0) {
                echo "<h3>People Involved</h3>";
                while($row = $resultspeople->fetch_assoc()) {
                    echo "ID #: ".$row["associationID"]."<br>Name: ".$row["lastName"].", ".$row["firstName"]." Job:".$row["jobTitle"]." ".$row["emailAddress"];

                    $sqlpeopleIP = "SELECT IPAddress FROM ipaddress where incidentID =".$_POST["incidentID"]." and associationID = ".$row["associationID"];
                    $IPresult = $conn->query($sqlpeopleIP);
                    $IP = $IPresult->fetch_assoc();
                    echo " ".$IP["IPAddress"]."<br><br>";
                }
            } else {
                echo "<h3>No People Involved</h3>";
            }

            // Prints comments from incident // -------------------------------------------------
            $sql2 = "SELECT * FROM comment WHERE incidentID=" . $_POST["incidentID"] . " ORDER BY commentDate DESC";
          
            $result2 = $conn->query($sql2);
           
            if ($result2->num_rows >  0) {
                // output data of each row
                echo "<h3>Comments</h3>";
                while($row = $result2->fetch_assoc()) {
                    echo $row["commentDate"]."<br>"."Handled By: ".$row["handlerName"]."<br>"
                    .$row["commentDescription"]."<br><br>";
                }
            } else {
                echo "<h3>No Comments</h3>";
            }

            $conn->close();
        ?>
        
        <form action="IncidentReports.html"> 
            <input type="submit" value="Go Back to Main Page"><br>
        </form>
    </body>
</html>