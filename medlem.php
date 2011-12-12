<?php

session_start();

if ($_SESSION['username'])
	echo "Välkommen, " $_SESSION['username']."!<br><a href='logout.php'>logga ut</a><br><a href='changepassword.php'>byt lösen</a>";
else
	die("du måstre vara inloggad");


?>
