<?php

echo "<h1>Registrera</h1>";

$submit = $_POST['submit'];

// formulär data

$fullname = strip_tags($_POST['fullname']);
$username = strip_tags($_POST['username']);
$password = strip_tags($_POST['password']);
$repeatpassword = strip_tags($_POST['repeatpassword']);
$date = date("Y-m-d");
$email = $_POST['email'];

if ($submit)
	{
		// kolla att användaren existerar
		if ($fullname&&$username&&$password&&$repeatpassword)
		{
		

		if ($password==$repeatpassword)
		{
		// kolla längden på användarnamnet och det fulla namnet
		if (strlen($username)>25||strlen($fullname)>25)
		{
			echo "för lång längd på nåt av namnen";
		}
		else
		{
			// kolla lösenlängd
			if (strlen($password)>25||strlen($password)<6)
			{
				echo "lösen måste vara mellan 6 och 25 karaktärer";
			}
			else
			{
			// registrera användaren
			
			// md5 gör lösenordet krypterat
			$password 		 = md5($password);
			$repeatpassword = md5($repeatpassword);

			// aktivations process

			$random = rand(23456789,98756432);

			// öppna databasen
			$connect = mysql_connect("localhost", "root", "");
			mysql_select_db("namn.db"); // välj databas

			$qwertyreg = mysql_qwerty("

			INSERT INTO users VALUES ('','$fullname','$username','$password','$email','$date','$number','0')

			");

			$lastid = mysql_insert_id();

			//skicka emailaktivation
			$to 		= $email;
			$subject = "aktivera ditt acc";
			$headers = "from: me";
			$server  = "oskar.schott@live.se";

			ini_set("SMTP",$server);

			$body = "

			hello $fullname, \n\n

			du måste aktivera accet via länken nedan: 
			http://localhost/form/activate.php?id=$lastid&code=$random \n\n

			";

			//funktion för att skicka mejlet
			mail($to, $subject, $body, $headers);
			

			die ("du e nu registrerad. <a href='index.login.php'>klicka</a>för att återvända");
			}


		}

		}
			else
				echo "lösenorden matchar inte";
		}
		else 
			echo "fyll i alla fälten";


}
?>

<html>
<meta charset="utf-8" />
<form action="register.php" method="POST">
	<table>
		<tr>
			<td>
			Namn:
			</td>
			<td>
			<input type="text" name="fullname" value="<?php echo $fullname; ?>">
			</td>
		</tr>
		<tr>
			<td>
			användarnamn:
			</td>
			<td>
			<input type="text" name="username" value="<?php echo $username; ?>">
			</td>
		</tr>
		<tr>
			<td>
			välj ett password:
			</td>
			<td>
			<input type="password" name="password">
			</td>
		</tr>
		<tr>
			<td>
			upprepa password
			</td>
			<td>
			<input type="password" name="repeatpassword">
			</td>
		</tr>
		<tr>
			<td>
			Email:
			</td>
			<td>
			<input type="text" name="email">
			</td>
		</tr>
	</table>
	<p>
	<input type="submit" name ="submit" value="registrera">
</html>
