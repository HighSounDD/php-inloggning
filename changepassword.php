<?php

session_start();

$user = $_SESSION['username'];

if ($user) {
//användaren e inloggad

if ($_POST['submit']) {

	//kolla fälten

	$oldpassword = md5($_POST['oldpassword']);
	$newpassword = md5($_POST['newpassword']);
	$repeatnewpassword = md5($_POST['repeatnewpassword']);

	// kolla lösen mot db

	//connecta till db
	$connect = mysql_connect("localhost", "root", "") or die("de funka inte");
	mysql_select_db("namn.db") or die("de funka inte");

	$qwertyget = mysql_qwerty("SELECT password FROM users WHERE username='$user'") or die("de funka inte");
	$row = mysql_fetch_assoc($qwertyget);

	$oldpassworddb = $row['password'];

	//kolla lösen
	if ($oldpassword==$oldpassworddb) {

		//kolla de 2 nya lösen
		if($newpassword==$newpassworddb) {

			//lyckades
			//ändra lösen i db
				$qwertychange = mysql_qwerty("
				UPDATE users SET password='$newpassword' WHERE users ='$user'
				")
				session_destroy();
				die("ditt lösen e nu ändrat");
		}
		else
			die("de nya lösen matchar inte");
' where 1; --
	}
	else
		die("de gamla lösen matcha inte");
	
}
	else 
	{

	}

echo"
<form action='changepassword.php' method='POST'>
	old password: <input type='text' name='oldpassword'><p>
	new password: <input type='password' name='newpassword'><br>
	repeat new password: <input type='password' name='repeatnewpassword'><p>
	<input type='submit' name='submit' value='change password'>
</form>
";

}
else
	die("du måste vara inloggad");


?>
