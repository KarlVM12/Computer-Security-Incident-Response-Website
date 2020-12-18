<!DOCTYPE html>
<html>
    <div class="header">
        <h1 class="logo">CSIRT</h1>
    </div>
    <head>
        <title>Modify Report - People</title>
    </head>
    <body>
        <h1 class="title">Computer Security Incident Response Team Reports</h1>
        <hr>
        <div class="content">
        <h3 class="content-title">Modify an Incident Report - Remove People</h3>

        <p class="paragraph"> Removing Person with Association ID <?php echo $_POST["associationID"]; ?> </p>

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
            
            $sql = "DELETE FROM INVOLVEDPERSON WHERE associationID = ".$_POST["associationID"]." AND incidentID = ".$_POST["incidentID"];
           
            $result = $conn->query($sql);

            //update comment to incindent
            $sqlhandler = "SELECT handlerName FROM incident WHERE incidentID = ".$_POST["incidentID"];
            $handlerNameResult = $conn->query($sqlhandler);
                $handlerName = $handlerNameResult->fetch_assoc();

                $date = date("Y-m-d");

                $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'Person Removed', '".$date."','".$handlerName["handlerName"]."')";
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
