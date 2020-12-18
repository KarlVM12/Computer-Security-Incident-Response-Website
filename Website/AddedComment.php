<!DOCTYPE html>
<html>
    <div class="header">
        <h1 class="logo">CSIRT</h1>
    </div>
    <head>
        <title>Modify Report - Comment</title>
        <link rel="stylesheet" type="text/css" href="styles.css"></link>
        
    </head>
   
    <body class="body">
        <h1 class="title">Computer Security Incident Response Team Reports</h1>
        
        <div class="content">
        <h3 class>Modify an Incident Report - Add Comment</h3>

        <p>Adding Comment to Incident # <?php echo $_POST["incidentID"]; ?> </p>

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

            $date = date("Y-m-d");
            
            $sql = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'".$_POST["commentDescription"]."','".$date."','".$_POST["handlerName"]."')";

            $result = $conn->query($sql);
            
            //update comment to incindent
            $sqlhandler = "SELECT handlerName FROM incident WHERE incidentID = ".$_POST["incidentID"];
            $handlerNameResult = $conn->query($sqlhandler);
            $handlerName = $handlerNameResult->fetch_assoc();

            $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'Comment Added', '".$date."','".$_POST["handlerName"]."')";
            $conn->query($sqlcomment);
            
            $conn->close();
        ?>

        <p>Added!</p>
            
        <form action="IncidentReports.html"> 
            <input type="submit" value="Go Back to Main Page"><br>
        </form>
    </div>
    </body>
</html>
