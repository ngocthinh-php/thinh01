<!DOCTYPE html>
<html>
<head>
	<style> 
.error {color: #FF0000;}
</style>
	<title></title>
</head>
<body>
<?php
funcion pg_connection_string_from_database_url(){
	extract((parse_url($_ENV["DATABASE_URL"]));
	return "user= $user password=$pass host=$host dbname=" . substr($path, 1);
}
	$db = pg_connection_string_from_database_url());
	if (!db) {
		echo "Error : Unable to open database\n";
	}else {
		echo "Opened database successfully\n";	
	}
	$sql="Select * from MyAccounts";
	print "<br>$sql<br>";
	$ret = pg_query($db, $sql);
	if (!$ret){
		# code...
		echo pg_last_error($db);
		exit();
 	}
?>
	<table border="1" cellspacing="2" cellpadding="2">
	<tr><td>Username</td><td>Password</td></tr>	
<?php
	while ($myrow = pg_fetch_assoc($ret)) {
		# code...
		print("<tr><td>%s</td><td>%s</td></tr>".$myrow['username'], $myrow['password']);
	}
	pg_close($db);
?>
	</table> 	
<br><a href=index.php>HOME</a>
</body>
</html>
