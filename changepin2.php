<html>

<head><title>Change password</title></title>

<body background="exam13.jpg">
<form action="home.php" method="post">

<?php
$flag=0;
$uname=$_POST["textField1"];
$username=strtoupper($uname);
$password1=$_POST["passWord1"];
$password2=$_POST["passWord2"];
$password3=$_POST["passWord3"];

//echo $password1.$user;

//database connectivity
$servername="localhost";
$user="root";
$pword="";
$link=mysql_connect($servername,$user,$pword)
	or die("Unable to connect Database :".mysql_error()."</br>");

//database selection
mysql_select_db("examdb",$link)
	or die("Can't select database :".mysql_error()."</br>");

$sql="select password from studentsdetails where username='$username';";
$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
if(mysql_num_rows($result)>0)
{
	while($row=mysql_fetch_array($result))
	{
	$password4=$row["password"];
	}
}

?>

<?php if (mysql_num_rows($result)>0): ?>
		<?php if($password1!=$password4) : ?>
		</br></br>
		<font color="red" size="4" align="center"><em>
		<h3>Invalid username and password!</h3>
		</em></font>
		<?php $flag=0; ?>

		<?php else: ?>
		<?php $flag=1; ?>

		<?php endif; ?>
			
<?php else : ?>
		</br></br>
		<font color="red" size="4" align="center"><em>
		<h3>Invalid username and password!</h3>
		</em></font>
		<?php $flag=0; ?>

<?php endif; ?>

<?php if(strlen($password2)<8): ?>
	<font color="red" size="4" align="center"><em>
	<h3>Invalid Password!</h3>
	<?php $flag=0; ?>
	</em></font>
<?php endif; ?>

<?php if($password2!=$password3): ?>
	<font color="red" size="4" align="center"><em>
	<h3>Please confirm Password!</h3>
	</em></font>
	<?php $flag=0; ?>

<?php endif; ?>

<?php if ($flag==0): ?>
	<em align="center">
	<h3><a href="changepin.php">Try againg</a></h3>
	</em>

<?php endif; ?>

<?php
if ($flag==1)
{
$sql="update studentsdetails set password='$password3' where username='$username';";
$result=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
$flag=2;
}
?>
</br></br>
<?php if ($flag==2): ?>
		<font color="green" size="4">
		<?php mysql_close($link); ?>
		<h3 align="center"><em>Password changed successfully.<a href="home.php">Home</a></em></h3>
		
		</em></font>
<?php endif; ?>

</form>
</body>
</html>
