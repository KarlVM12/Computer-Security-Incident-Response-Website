<!DOCTYPE html>
<html>
    <head>
        <title>New Report - Creating A New Report</title>
    </head>
    <body>
        <h1>Computer Security Incident Response Team Reports</h1>
        <hr>
        <h3>Creating A New Report - Making A New Report</h3>

        <p> Making A New Report : Incident # <?php echo $_POST["incidentID"]; ?></p>

        <?php 
            $servername = "localhost";
            $username = "root"; // Mysql username
            $password = "1234";	// Mysql Password

            $dbname = "csirt";	// database name
            
            // Create connection
            // MySQLi is Object-Oriented method
            $conn = new sqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("connection failed: " . $conn->connect_error ."<br>");
            } 
            
            $sql1 = "INSERT INTO INCIDENT VALUES (".$_POST["incidentID"].",'".$_POST["incidentType"]."','".$_POST["creationDate"]."',,'".$_POST["incidentState"]."','".$_POST["handlerName"]."',".$_POST["associationID"].")";
            
            $sql2 = "INSERT INTO COMMENT VALUES (null,".$_POST["incidentID"].",'".$_POST["commentDescription"]."','".$_POST["commentDate"]."','".$_POST["handlerName"]."')";

            #sql3 = 'INSERT INTO PERSON VALUES (".$_POST["associationID"].",'".$_POST["lastName"]."','".$_POST["firstName"]."','".$_POST["jobTitle"]."','".$_POST["emailAddress"]."')";

            $sql4 = "INSERT INTO IPADDRESS VALUES (".$_POST["associationID"].",'".$_POST["IPAddress"]."',".$_POST["incidentID"].")";

            $sql5 = "INSERT INTO HANDLER VALUES ('".$_POST["handlerName"]."')";

            $result = $conn->query($sql1);   
            $result = $conn->query($sql2);
            $result = $conn->query($sql3);
            $result = $conn->query($sql4);
            $result = $conn->query($sql5);

            $conn->close();
        ?>
        <p>Added!</p>

    </body>
</html>