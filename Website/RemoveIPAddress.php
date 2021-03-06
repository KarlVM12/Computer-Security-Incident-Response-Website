<!DOCTYPE html>
<html>
    <div class="header">
        <h1 class="logo">CSIRT</h1>
    </div>
    <head>
        <title>Modify Report - IP Addresses</title>
        <link rel="stylesheet" type="text/css" href="styles.css"></link>

    </head>
    <body>
        <h1 class="title">Computer Security Incident Response Team Reports</h1>
        
        <div class="content">
        <h3 class="content-title">Modify an Incident Report - Remove IP Addresses</h3>

            <p class="paragraph"> Removing IP Address <?php echo $_POST["IPAddress"]; ?> to Incident # <?php echo $_POST["incidentID"]; ?></p>

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

                //update comment to incindent
                $sqlhandler = "SELECT handlerName FROM incident WHERE incidentID = ".$_POST["incidentID"];
                $handlerNameResult = $conn->query($sqlhandler);
                $handlerName = $handlerNameResult->fetch_assoc();

                $date = date("Y-m-d");

                $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'IP Address Removed', '".$date."','".$handlerName["handlerName"]."')";
                $conn->query($sqlcomment);
                
                $conn->close();
            ?>

            <p class="paragraph">Removed!</p>
            
            <br><hr>
            <form class="form" action="IncidentReports.html">
                <input class="user-submit" type="submit" value="Main Page"><br>
            </form>
        </div>
    </body>
</html>
