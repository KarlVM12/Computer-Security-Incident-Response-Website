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
        <h3 class="content-title">Modify an Incident Report - Add Comment</h3>

        <form class="form" method ="POST">
            <label class="label" for ="incidentID">Incident ID</label> <br>
            <input class="user-input" type ="text" name="incidentID" required><br>

            <!--
            <label for ="commentDescription">Comment Description</label> <br>
            <input type ="text" name="commentDescription" required><br><br>
            -->

            <label class="label" for ="commentDescription">Comment Description</label> <br>
            <textarea class="user-input" rows="5" cols="16" name="commentDescription"></textarea><br>
            
            <label class="label" for ="commentDate">Comment Date</label> <br>
            <input class="user-input" type ="date" name="commentDate" required><br>

            <label class="label" for ="handlerName">Handler Name</label> <br>
            <input class="user-input" type ="text" name="handlerName" required><br><br>

            <input class="user-submit" type="submit" value="Add Comment"><br> #formaction="AddedComment.php"
        </form>
        
        <p>THE PHP IS BELOW</p>
        <?php
            $servername = "localhost";
            $username = "root"; // Mysql username
            $password = "";	// Mysql Password

            $dbname = "csirt";	// database name
            
            // Create connection
            // MySQLi is Object-Oriented method
            $conn = new mysqli($servername, $username, $password, $dbname);
            
            // Check connection
            if ($conn->connect_error) {
                die("connection failed: " . $conn->connect_error ."<br>");
            } 
            
            $commentDate = $_POST['commentDate'];
            $commentDescription = $_POST['commentDescription']

            $sql = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'$commentDescription','$commentDate','".$_POST["handlerName"].")";

            $result = $conn->query($sql);
            
            //update comment to incindent
            $sqlhandler = "SELECT handlerName FROM incident WHERE incidentID = ".$_POST["incidentID"];
            $handlerName = $conn->query($sqlhandler);

            $sqlcomment = "INSERT INTO comment VALUES (null,".$_POST["incidentID"].",'Comment Added', '".date("Y-m-d")."','".$handlerName."')";
            $conn->query($sqlcomment);
            
            $conn->close();
        ?>
    </div>
    </body>
</html>
