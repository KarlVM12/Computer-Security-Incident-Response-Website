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
         
         $result1 = $conn->query($sql1);
         $result2 = $conn->query($sql2);
         $result3 = $conn->query($sql3);
         $result4 = $conn->query($sql4);

         $row1 = $result1->fetch_assoc();
         
            // output data of each row
            $row2 = $result2->fetch_all();
                  
      
        
         $row3 = $result3->fetch_assoc();
         $row4 = $result4->fetch_assoc();

         echo "<h4>Incident</h4><br><table> <tr> <th>incidentID</th>  <th>incidentType</th> <th>creationDate</th> <th>incidentState</th> <th>incidentName</th> <th>handlerName</th> </tr>".
               "<tr><td>".$row1["incidentID"]."</td>"."<td>".$row1["incidentType"]."</td>"."<td>".$row1["creationDate"]."</td>"."<td>".$row1["incidentState"]."</td>"."<td>".$row1["incidentName"]."</td>"."<td>".$row1["handlerName"]."</td></tr>"."</table>";

               echo "\n<h4>Involved People</h4><br><table> <tr> <th>associationID</th> <th>incidentID</th> </tr>".
               "<tr><td>".$row2["associationID"]."</td>"."<td>".$row2['incidentID']."</td></tr>"."<table>";
         echo "\n<h4>Comments</h4><br><table> <tr> <th>commentID</th> <th>incidentID</th> <th>commentDescription</th> <th>commentDate</th> <th>handlerName</th> </tr>".
               "<tr><td>".$row3["commentID"]."</td>"."<td>".$row3['incidentID']."</td>"."<td>".$row3['commentDescription']."</td>"."<td>".$row3['commentDate']."</td>"."<td>".$row3['handlerName']."</td></tr>"."</table>";
         
         echo "\n<h4>IP Address</h4><br><table> <tr> <th>associationID</th> <th>IPAddress</th> <th>incidentID</th> </tr>".
               "<tr><td>".$row4['associationID']."</td>"."<td>".$row4['IPAddress']."</td>"."<td>".$row4['incidentID']."</td></tr>"."</table>";
      
      //FORMAT FOR ABOVE
      "select associationID from incident join involvedperson on incident.incidentID=involvedperson.incidentid where incident.incidentid= 972132;"
         #echo $sqlresults;
      
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
