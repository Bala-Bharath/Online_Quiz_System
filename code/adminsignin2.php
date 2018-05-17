<html>

<head><title>Question and Answer</title></head>

<body background="../images/exam13.jpg">
<form action=" " method="post">

<?php
$uname=$_POST["textField1"];
$username=strtoupper($uname);
$password1=$_POST["passWord"];
$password2;
if($username=="ADMINISTRATOR")
{
$ch=1;
	//database connectivity
	$servername="localhost";
	$user="root";
	$pword="";
	$link=mysql_connect($servername,$user,$pword)
		or die("Unable to connect Database :".mysql_error()."</br>");

	//database selection
	mysql_select_db("examdb",$link)
		or die("Can't select database :".mysql_error()."</br>");

	$sql="select password from studentsdetails where username='ADMINISTRATOR';";
	$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
			
		while($row=mysql_fetch_array($result))
		{
		$password2=$row["password"];
		}

}

?>

<?php $password2; ?>
<?php if ($ch==1): ?>
		<?php if(!strcmp($password1,$password2)) : ?>
			</br></br></br>
			<font color="red" size="4">
			<h3 align="center"><em> ( 
			<a href="question.php">Question and time arrangements</a> / 
			<a href="changepin.php" > Change password</a> ) 
			</em></h3></font>
			<em><h3 align="center"><a href="Home.php">Home</a></h3></em>
		<?php else: ?>
			</br></br>
			<font color="red" align="center"><em>
			<h3>Invalid username and password!</h3>
			</em></font>
			<em>
			<h3 align="center"><a href="adminsignin.php">Try againg</a></h3>
			<h3 align="center"><a href="Home.php">Home</a></h3>
			</em>
		
		<?php endif; ?>
			
<?php else : ?>
		</br></br>
		<font color="red" align="center"><em>
		<h3>Invalid username and password!</h3>
		</em></font>
		<em>
		<h3 align="center"><a href="adminsignin.php">Try againg</a></h3>
		<h3 align="center"><a href="Home.php">Home</a></h3>
		</em>
<?php endif; ?>

</form>
</body>
</html>
