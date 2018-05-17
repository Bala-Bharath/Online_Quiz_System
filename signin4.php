<html>

<head><title>Question and Answer</title></head>

<body background="exam13.jpg">
<form action="" method="post">

<?php
$uname=$_POST["textField1"];
$username=strtoupper($uname);
$password1=$_POST["passWord"];

//database connectivity
$servername="localhost";
$user="root";
$password="";
$link=mysql_connect($servername,$user,$password)
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
	$password2=$row["password"];
	}
}
?>
<?php if (mysql_num_rows($result)>0): ?>
		<?php if(strcmp($password1,$password2)) : ?>
		</br></br>
		<font color="red" size="4"><em>
		<h3 align="center">Invalid username and password!</h3>
		<h3 align="center"><em><a href="signin.php">Try againg</a></h3>
		</em></font>
		
		<?php else: ?>
		</br></br></br>
		<?php
		$sql="update questiondetails set inc='0';";
		$result1=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
		$sql="update questiondetails set inc='1' where question_no='1';";
		$result2=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");

		$sql="create table if not exists lastuser(number int not null,username varchar(50) not null,password varchar(50) not null);";
		mysql_query($sql) or die (mysql_error());

		
		$sql="truncate table lastuser";
		$result1=mysql_query($sql) or die("Unable to truncate :".mysql_error()."</br>");

		$sql="create table if not exists lastmark(mark varchar(5) not null);";
		mysql_query($sql) or die (mysql_error());
		
		$sql="truncate table lastmark";
		$result2=mysql_query($sql) or die("Unable to truncate :".mysql_error()."</br>");

		$sql="insert into lastuser values('1','$username','$password1');";
		mysql_query($sql) or die ("Unable to insert :".mysql_error()."</br>");
		
		?>
		<font color="red" size="4">
		<h3 align="center"><em>( <a href="studques.php">View question</a> / <a href="changepin.php">change password</a> )</em></h3>
		<h3 align="center"><em>&nbsp&nbsp&nbsp<a href="home.php" >Home</a></em></h3>
		</font>
		<?php endif; ?>
			
<?php else : ?>
		</br></br>
		<font color="red" size="4"><em>
		<h3 align="center">Invalid username and password!</h3>
		<h3 align="center"><em align="center"><a href="signin.php">Try againg</a></h3>
		</em></font>s

		</em>
<?php endif; ?>


</form>
</body>
</html>
