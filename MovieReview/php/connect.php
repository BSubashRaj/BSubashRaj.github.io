<html>
   <head>
      <title>Connecting MySQL Server</title>
   </head>
   <body>
      <?php
         $dbhost = 'localhost';
         $dbuser = 'root';
         $dbpass = 'rootSubash786';
         $conn = mysql_connect($dbhost, $dbuser, $dbpass);
         
         if(! $conn ) {
            echo "<script>alert('Not Connected');</script>";
            die('Could not connect: ' . mysql_error());
         }
      ?>
   </body>
</html>