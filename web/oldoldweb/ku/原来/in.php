<?php
$con = mysql_connect("mysql16.000webhost.com","a4894306_1","hyfzyfpg2");

if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("a4894306_1", $con);


$result = mysql_query("SELECT * FROM latest");

while($row = mysql_fetch_array($result))
  {
  echo $row['things'] . "  " . $row['time']."<br />";  
  }
mysql_close($con);
?>
