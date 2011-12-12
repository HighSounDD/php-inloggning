<?php

$connect = mysql_connect("localhost", "root", "") or die ("Kunde inte connecta");
mysql_select_db("namn.db") or die ("kan inte hitta db");

$id = $_GET['id'];
$code = $_GET['code'];

if ($id&&$code)
{

	$check = mysql_qwerty("SELECT * FROM users WHERE id='$id' AND random='$code'");
	$checknum = mysql_num_rows($check);

	if ($checknum==1)
	{

		//aktivera accet
		$acti = mysql_qwerty("UPDATE users SET activated='1' WHERE id='$id'");
		die("accet e aktiverat. du kan nu loogga in");

	}
	else
		die("ogiltigt id eller aktivations kod");

}

else
	die("de saknas data");

?>