<!DOCTYPE html>
<html>
    <div class="header">
        <h1 class="logo">CSIRT</h1>
    </div>
    <head>
        <title>Modify Report - IP Addresses</title>
        <link rel="stylesheet" type="text/css" href="styles.css"></link>

    </head>
    <body class="body">
        
        <h1 class="title">Computer Security Incident Response Team Reports</h1>
        <div class="content">
        <h3 class="content-title">Modify an Incident Report - Add IP Addresses</h3>

        <p class="paragraph"> Adding IP Address <?php echo $_POST["IPAddress"]; ?> to Incident # <?php echo $_POST["incidentID"]; ?>

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
            
            $sql = "INSERT INTO ipaddress VALUES (".$_POST["associationID"].",'".$_POST["IPAddress"]."',".$_POST["incidentID"].")";

            $result = $conn->query($sql);

            //update comment to incindent
            $sqlhandler = "SELECT handlerName FROM incident WHERE incidentID = ".$_POST["incidentID"];
            $handlerName = $conn->query($sqlhandler);

            $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'IP Address Added', '".date("Y/m/d")."','".$handlerName."')";
            $conn->query($sqlcomment);
            
            $conn->close();
        ?>
        <p class="paragraph">Added!</p>
        
        <form class="form" action="IncidentReports.html"> 
            <input class="user-submit" type="submit" value="Main Page"><br>
        </form>
        </div>
    </body>
</html>


            $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'IP Address Added', '".date("Y/m/d")."','".$handlerName."')";
            $conn->query($sqlcomment);
            
            $conn->close();
        ?>
        <p>Added!</p>
        
        <form action="IncidentReports.html"> 
            <input type="submit" value="Go Back to Main Page"><br>
        </form>

    </body>
</html>
