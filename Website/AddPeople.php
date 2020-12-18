<!DOCTYPE html>
<html>
    <div class="header">
        <h1 class="logo">CSIRT</h1>
    </div>
    <head>
        <title>Modify Report - People</title>
        <link rel="stylesheet" type="text/css" href="styles.css"></link>

    </head>
    <body class="body">
        <h1 class="title">Computer Security Incident Response Team Reports</h1>
        <div class="content">
            <h3 class="content-title">Modify an Incident Report - Add People</h3>

            <p class="paragraph"> Adding Person with Association ID <?php echo $_POST["associationID"]; ?> </p>

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

                //update comment to incindent
                $sqlhandler = "SELECT handlerName FROM incident WHERE incidentID = ".$_POST["incidentID"];
                $handlerName = $conn->query($sqlhandler);

                $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'Person Added', '".date("Y/m/d")."','".$handlerName."')";
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

