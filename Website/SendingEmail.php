<!DOCTYPE html>
<html>
   <div class="header">
        <h1 class="logo">CSIRT</h1>
    </div>
   <head>
      <title>Sending Email</title>
      <link rel="stylesheet" type="text/css" href="styles.css"></link>

   </head>
   <body class="body">
      <div class="content">
      <h3 class=>Emaling</h3>
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

         $sqlresults = "";
         
         $sql1 = "SELECT * FROM incident WHERE incidentID=" . $_POST["incidentID"] . "";
          
         $result1 = $conn->query($sql1);
           
         if ($result1->num_rows >  0) {
             // output data of each row
             while($row = $result1->fetch_assoc()) {
                 $sqlresults .= "<h3>Incident ID # ".$_POST["incidentID"]."</h3><br>". 
                 "Incident Created on: ".$row["creationDate"]."<br>". 
                 "Reason for Incident: ".$row["incidentType"]."<br>". 
                 "Incident Description: ".$row["incidentName"]."<br>". 
                 "State of the Incident: ".$row["incidentState"]."<br>". 
                 "Currently Being Handled By: ".$row["handlerName"]."<br><br>";
             }
         } else {
            $sqlresults .= "<h3>No Incident With this ID</h3>";
         }

            // People Involved // ---------------------------------------------------------------
         $sqlpeople = "select * from incident join involvedperson on incident.incidentID=involvedperson.incidentid join person on person.associationID = involvedperson.associationID where incident.incidentid =".$_POST["incidentID"];
         $resultspeople = $conn->query($sqlpeople);

         if ($resultspeople->num_rows >  0) {
             $sqlresults .= "<h3>People Involved</h3>";
             while($row = $resultspeople->fetch_assoc()) {
                 $sqlresults .= "ID #: ".$row["associationID"]."<br>Name: ".$row["lastName"].", ".$row["firstName"]."<br>".
                 "Job: ".$row["jobTitle"]."<br>Email Address: ".$row["emailAddress"]."<br>";

                 $sqlpeopleIP = "SELECT IPAddress FROM ipaddress where incidentID =".$_POST["incidentID"]." and associationID = ".$row["associationID"];
                 $IPresult = $conn->query($sqlpeopleIP);

                 if ($IPresult->num_rows >  0) {
                     $IP = $IPresult->fetch_assoc();
                     $sqlresults .= "IP Address: ".$IP["IPAddress"];
                 } else {
                     $sqlresults .= "No Associated IP Address";
                 }
                 
                 $sqlresults .= "<br><br>";
            }
         } else {
             $sqlresults .= "<h3>No People Involved</h3>";
         }

         // Prints comments from incident // -------------------------------------------------
         $sql2 = "SELECT * FROM comment WHERE incidentID=" . $_POST["incidentID"] . " ORDER BY commentDate DESC";
       
            $result2 = $conn->query($sql2);
           
            if ($result2->num_rows >  0) {
                // output data of each row
                $sqlresults .= "<h3>Comments</h3>";
                while($row = $result2->fetch_assoc()) {
                    $sqlresults .= $row["commentDate"]."<br>"."Handled By: ".$row["handlerName"]."<br>"
                    .$row["commentDescription"]."<br><br>";
                }
            } else {
                $sqlresults .= "<h3>No Comments</h3>";
            }

         $email_from = "'".$_POST["sendingemail"]."'";
         $email_subject = "CSIRT Report Email";
         $email_body = "You have received a new message from the user '".$_POST["name"]."'\n";
         $email_body .= "Here is the message:\n '".$_POST["message"]."'\n";
         $email_body .= "'".$sqlresults."'\n";
         
         $to = "'".$email_from."'";
         $headers = "From: '".$email_from."' \r\n";
         $headers .= "Reply-To: $email_from \r\n";
         mail($to,$email_subject,$email_body,$headers);

         $conn->close();
      ?>
      <p class="paragraph">Emailed!</p>
      <br><hr>
        <form class="form" action="IncidentReports.html">
            <input class="user-submit" type="submit" value="Main Page"><br>
        </form>
      </div>
   </body>
</html>
