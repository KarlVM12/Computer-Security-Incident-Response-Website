<!DOCTYPE html>
<div class="header">
	<h1 class="logo">CSIRT</h1>
</div>
<html>
    <head>
        <title>New Report - Creating A New Report</title>
        <link rel="stylesheet" type="text/css" href="styles.css"></link>
    </head>
    <body class="body">
        <h1 class="title">Computer Security Incident Response Team Reports</h1>
        <div class="content">
        <h3 class="content-title">Creating A New Report - Making A New Report</h3>

        <p class="paragraph"> Making A New Report : Incident # <?php echo $_POST["incidentID"]; ?></p>

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
            
            $sql1 = "INSERT INTO INCIDENT VALUES (".$_POST["incidentID"].",'".$_POST["incidentType"]."','".$_POST["creationDate"]."','".$_POST["incidentState"]."','".$_POST["incidentName"]."','".$_POST["handlerName"]."')";

            $sql2 = "INSERT INTO COMMENT VALUES (null,".$_POST["incidentID"].",'".$_POST["commentDescription"]."','".$date."','".$_POST["handlerName"]."')";

            $sql3 = "INSERT INTO PERSON VALUES (".$_POST["associationID"].",'".$_POST["lastName"]."','".$_POST["firstName"]."','".$_POST["jobTitle"]."','".$_POST["emailAddress"]."')";

            $sql4 = "INSERT INTO IPADDRESS VALUES (".$_POST["associationID"].",'".$_POST["IPAddress"]."',".$_POST["incidentID"].")";

            $sql5 = "INSERT INTO HANDLER VALUES ('".$_POST["handlerName"]."')";

            $sql6 = "INSERT INTO INVOLVEDPERSON VALUES (".$_POST["associationID"].",".$_POST["incidentID"].")";

            $result = $conn->query($sql5);
            $result = $conn->query($sql3);
            $result = $conn->query($sql1);   
            $result = $conn->query($sql2);
            $result = $conn->query($sql6);
            $result = $conn->query($sql4);
            
            $conn->close();
        ?>
        <p class="paragraph">Added!</p>
        <br>
        <form class="form" action="IncidentReports.html">
            <input class="user-submit" type="submit" value="Main Page"><br>
        </form>
    </body>
</html>
