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
            
            $sql = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'".$_POST["commentDescription"]."','".$_POST["commentDate"]."','".$_POST["handlerName"].")";

            $result = $conn->query($sql);
            
            $conn->close();
        ?>

        <p>Added!</p>
    </div>
    </body>
</html>