<!DOCTYPE html>
<html>
    <head>
        <title>Modify Report - Incident State</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <h3>Modify an Incident Report - Change Incident State</h3>

        <p> Changing Incident State of Incident # <?php echo $_POST["incidentID"]; ?> to <?php echo $_POST["incidentState"]; ?> </p>

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
            
            $sql = "UPDATE incident SET incidentState = '".$_POST["incidentState"]."' WHERE incidentID = ".$_POST["incidentID"];
            
            $result = $conn->query($sql);
            
            $conn->close();
        ?>
        <p>Changed!</p>

    </body>
</html>