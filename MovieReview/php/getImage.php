<?php

  $id = $_GET['id'];
  // do some validation here to ensure id is safe

  $link = mysql_connect("localhost", "root", "rootSubash786");
  mysql_select_db("MovieReview");
  $sql = "SELECT image FROM movies WHERE id = $id";
  $result = mysql_query($link,$sql);
  $image = mysql_fetch_assoc($result);
  mysql_close($link);

  header("Content-type: image/jpeg");
  echo $row['image'];
?>