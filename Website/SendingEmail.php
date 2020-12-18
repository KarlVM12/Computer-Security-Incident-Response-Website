<!DOCTYPE html>
<html>
   
   <head>
      <title>Sending Email</title>
   </head>
   <body>
      <h3>Emaling</h3>
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
         
         $sql1 = "SELECT * FROM INCIDENT WHERE incidentID = ".$_POST["incidentID"];
         $sql2 = "SELECT * FROM INVOLVEDPERSON WHERE incidentID = ".$_POST["incidentID"];
         $sql3 = "SELECT * FROM COMMENT WHERE incidentID = ".$_POST["incidentID"];
         $sql4 = "SELECT * FROM IPADDRESS WHERE incidentID = ".$_POST["incidentID"];
         
         $result = $conn->query($sql1);
         $result = $conn->query($sql2);
         $result = $conn->query($sql3);
         $result = $conn->query($sql4);

         $row = $result->fetch_assoc();

         $sqlresults = "<h4>Incident</h4><br><table> <tr> <th>incidentID</th>  <th>incidentType</th> <th>creationDate</th> <th>incidentState</th> <th>incidentName</th> <th>handlerName</th> </tr>".
               "<tr><td>".$row["incidentID"]."</td>"."<td>".$row["incidentType"]."</td>"."<td>".$row["creationDate"]."</td>"."<td>".$row["incidentState"]."</td>"."<td>".$row["incidentName"]."</td>"."<td>".$row["handlerName"]."</td></tr>"."</table>";

         $sqlresults .= "\n<h4>Involved People</h4><br><table> <tr> <th>associationID</th> <th>incidentID</th> </tr>".
               "<tr><td>".$row["associationID"]."</td>"."<td>".$row['incidentID']."</td></tr>"."<table>";
        
         $sqlresults .= "\n<h4>Comments</h4><br><table> <tr> <th>commentID</th> <th>incidentID</th> <th>commentDescription</th> <th>commentDate</th> <th>handlerName</th> </tr>".
               "<tr><td>".$row["commentID"]."</td>"."<td>".$row['incidentID']."</td>"."<td>".$row['commentDescription']."</td>"."<td>".$row['commentDate']."</td>"."<td>".$row['handlerName']."</td></tr>"."</table>";
         
         $sqlresults .= "\n<h4>IP Address</h4><br><table> <tr> <th>associationID</th> <th>IPAddress</th> <th>incidentID</th> </tr>".
               "<tr><td>".$row['associationID']."</td>"."<td>".$row['IPAddress']."</td>"."<td>".$row['incidentID']."</td></tr>"."</table>";
      
         echo $sqlresults;
      
         $email_from = "'".$_POST["sendingemail"]."'";
         $email_subject = "CSIRT Report Email";
         $email_body = "You have received a new message from the user '".$_POST["name"]."'\n".
         $email_body .= "Here is the message:\n '".$_POST["message"]."'\n".
         $email_body .= "'".$sqlresults."'\n";
         
         $to = "'".$email_from."'";
         $headers = "From: '".$email_from."' \r\n";
         $headers .= "Reply-To: $email_from \r\n";
         mail($to,$email_subject,$email_body,$headers);

         $conn->close();
      ?>
      <p>Emailed!</p>
   </body>
</html>
