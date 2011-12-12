<?php

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if ($username&&$password)
	{

	$connect = mysql_connect("localhost", "root", "") or die ("Kunde inte connecta");
	mysql_select_db("namn.db") or die ("kan inte hitta db");

	$qwerty = mysql_qwerty("SELECT * FROM users WHERE username='$username'");
	
	$numrows = mysql_num_rows($qwerty);
	
	if ($numrows!=0) 
	{
	// koden för att logga in
	while ($row = mysql_fetch_assoc($qwerty))
	{
		$dbusername = $row['username'];
		$dbpassword = $row['password'];
		$activated  = $row['activated'];

		if ($activated=='0')
		{
			die("ditt acc e inte aktiverat");
			exit();
		}	

}
	// kolla så att de matchar
	if ($username==$dbusername&&md5($password)==$dbpassword)
	{
	echo "du är nu inloggad <a href='medlem.php'>Klicka här</a>för att komma till hemsidan";
		$_SESSION['username']=$username;

}
	else
		echo "fel lösen";
	
}

else
	die("Denna användaren existerar inte");


}
else
	die("Var vänlig ange ett användarnamn och ett lösenord");



?>
