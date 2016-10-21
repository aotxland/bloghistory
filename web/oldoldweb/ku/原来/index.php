<html> 
<head> 
<title> ku</title> 
</head> 
<body bgcolor="#C6E2FF"> 



<br>
<form name="input" action="http://aotx.comyr.com/out.php" method="get">things: <input type="text" name="thing">
<input type="submit" value="ok">
</form>
<?php$con = mysql_connect("mysql16.000webhost.com","a4894306_1","hyfzyfpg2");
if (!$con)  {  die('Could not connect: ' . mysql_error());  }mysql_select_db("a4894306_1", $con);
$sql="INSERT INTO latest (things, time)VALUES('$_POST[things]','$_POST[time]')";
if (!mysql_query($sql,$con))  {  die('Error: ' . mysql_error());  }echo "1 record added";
mysql_close($con)?>
<br>
<br>
<center>aotxland@gmail.com</center>
<center><a href="http://aotx.comyr.com/">Ê×Ò³</a> </center>
<br>
<center><img src="http://aotx.comyr.com/logo.png" ></center>
</body> 
</html>   