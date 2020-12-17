<!DOCTYPE html>
<html>
    <head>
        <title>Modify Report - People</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <h3>Modify an Incident Report - Remove People</h3>

        <p> Removing Person with Association ID <?php echo $_POST["associationID"]; ?> </p>

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
            
            $sql = "DELETE FROM person WHERE associationID = ".$_POST["associationID"];
           
            $result = $conn->query($sql);
            
            $conn->close();
        ?>
        <p>Removed!</p>
        
        <form action="IncidentReports.html"> 
            <input type="submit" value="Go Back to Main Page"><br>
        </form>
        
    </body>
</html>
