<html>
   
   <head>
      <title>Sending Email</title>
   </head>
   <body>
      
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
            
            $sql = "SELECT * FROM INCIDENT WHERE incidentID = ".$_POST["incidentID"].";";
            $sql .= "SELECT * FROM INVOLVEDPERSON WHERE incidentID = ".$_POST["incidentID"].";";
            $sql .= "SELECT * FROM COMMENT WHERE incidentID = ".$_POST["incidentID"].";";
            $sql .= "SELECT * FROM IPADDRESS WHERE incidentID = ".$_POST["incidentID"].";";
            
            $result = $conn->query($sql);
      
          	$email_from = "$sendingemail";
	          $email_subject = "CSIRT Report Email";
	          $email_body = "You have received a new message from the user $name.\n".
            $email_body .= "Here is the message:\n $message\n".
            $email_body .= "$result\n";
          
            $to = "$email_from";
            $headers = "From: $email_from \r\n";
            $headers .= "Reply-To: $visitor_email \r\n";
            mail($to,$email_subject,$email_body,$headers);
      ?>
      
   </body>
</html>