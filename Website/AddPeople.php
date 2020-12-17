<!DOCTYPE html>
<html>
    <head>
        <title>Modify Report - People</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <h3>Modify an Incident Report - Add People</h3>

        <p> Adding Person with Association ID <?php echo $_POST["associationID"]; ?> </p>

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
            
            
            $sql1 = "INSERT INTO person VALUES (".$_POST["associationID"].",'".$_POST["lastName"]."','".$_POST["firstName"]."','".$_POST["jobTitle"]."','".$_POST["emailAddress"]."')";
            $sql2 = "INSERT INTO INVOLVEDPERSON VALUES (".$_POST["associationID"].",".$_POST["incidentID"].")";

            $result = $conn->query($sql1);
            $result = $conn->query($sql2);
            
            $conn->close();
        ?>
        <p>Added!</p>
        
        <form action="IncidentReports.html"> 
            <input type="submit" value="Go Back to Main Page"><br>
        </form>
        
    </body>
</html>
