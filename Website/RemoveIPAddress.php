<!DOCTYPE html>
<html>
    <head>
        <title>Modify Report - IP Addresses</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <h3>Modify an Incident Report - Remove IP Addresses</h3>

        <p> Removing IP Address <?php echo $_POST["IPAddress"]; ?> to Incident # <?php echo $_POST["IncidentID"]; ?></p>

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
            
            $sql = "DELETE FROM ipaddress WHERE associationID = ".$_POST["associationID"]." and ipaddress = '".$_POST["IPAddress"]."' and incidentID = ".$_POST["incidentID"];
            $result = $conn->query($sql);
            
            $conn->close();
        ?>

        <p>Removed!</p>

    </body>
</html>