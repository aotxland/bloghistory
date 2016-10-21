<?php
$con = mysql_connect("mysql16.000webhost.com","a4894306_1","hyfzyfpg2");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("a4894306_1", $con);


$sql="INSERT INTO latest (things, time)
VALUES
('$_POST[things]','$_POST[time]')";


if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con)
?>