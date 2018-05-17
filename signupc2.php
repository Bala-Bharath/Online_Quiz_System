<html>

<head>
<title>Thanks you!</title>
</head>

<body background="exam13.jpg">
<form action="signupc2.php" method="post" >

<?php 
$flag=0; 
?>

<font color="red" size="4"><em>

<?php if ((date("20y-m-d")-$_POST["textField2"])<18) :?>
	<h3 align="center">year age is less then 18!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if (strlen($_POST["textField3"])!=10): ?>
	
	<h3 align="center">Invalid mobile number!</h3>
	<?php $flag=1; ?>
<?php endif; ?>


<?php if(!strstr($_POST["textField4"],"mail.com")): ?>
	<h3 align="center">Invalid Email Id!</h3>
	<?php $flag=1; ?>
<? endif; ?>

<?php if(strlen($_POST["textField8"])!=6): ?>
	<h3 align="center">Invalid Pincode!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if(strlen($_POST["passWord1"])<8): ?>
	<h3 align="center">Invalid Password!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if(strcmp($_POST["passWord1"],$_POST["passWord2"])): ?>
	<h3 align="center">Please confirm Password!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if (empty($_POST["textField1"]) || empty($_POST["textField2"]) || empty($_POST["textField12"]) || empty($_POST["textField5"]) || empty($_POST["textField6"]) || empty($_POST["textField7"]) || empty($_POST["textField9"]) || empty($_POST["textField10"]) || empty($_POST["textField11"]) || (empty($_POST["radioButton1"]) && empty($_POST["radioButton2"]))): ?>
	<h3 align="center">Don't enter null value!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

</em></font>

<?php
if ($flag==0)
{
$name=$_POST["textField1"];
$guardian=$_POST["textField12"];
$dob=$_POST["textField2"];
$age=date("20y-m-d")-$dob;
$mobileno=$_POST["textField3"];
$emailid=$_POST["textField4"];


if($_POST["radioButton1"])
$gender=$_POST["radioButton1"];
else
$gender=$_POST["radioButton2"];

$street=$_POST["textField5"];
$post=$_POST["textField6"];
$city=$_POST["textField7"];
$pincode=$_POST["textField8"];
$state=$_POST["textField9"];
$country=$_POST["textField10"];
$uname=$_POST["textField11"];
$username=strtoupper($uname);
$password1=$_POST["passWord1"];
$password2=$_POST["passWord2"];

//database connectivity
$servername="localhost";
$user="root";
$password="";
$link=mysql_connect($servername,$user,$password)
	or die("Unable to connect Database :".mysql_error()."</br>");


//database creation
$sql="create database if not exists examdb";
mysql_query($sql,$link)
	or die("Error creating database :".mysql_error()."</br>");

//database selection
mysql_select_db("examdb",$link)
	or die("Can't select database :".mysql_error()."</br>");

//table creation
$sql="create table if not exists studentsdetails(name varchar(50) not null,father_or_guardian_name varchar(50) not null,dob date not null,age int not null,mobile_no double not null,email_id varchar(50) not null,gender varchar(10) not null,street varchar(20) not null,post varchar(50) not null,city varchar(50) not null,pincode double not null,state varchar(50) not null,country varchar(50) not null,username varchar(50) not null,password varchar(20) not null,mark int not null,inc int not null,primary key(username),unique(email_id));";
mysql_query($sql)
	or die (mysql_error());
//insertion
$sql="insert into studentsdetails values('$name','$guardian','$dob','$age','$mobileno','$emailid','$gender','$street','$post','$city','$pincode','$state','$country','$username','$password1','0','0')";
mysql_query($sql) or die ("Unable to insert :".mysql_error()."</br>");

//updation
$sql="update studentsdetails set inc='1' where username='ADMINISTRATOR';";
mysql_query($sql) or die ("Unable to update :".mysql_error()."</br>");


//selection
$sql="select * from studentsdetails where username='$username';";
$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
}
?>

<?php if ($flag==1): ?>
	<font color="green" size="4">
	<h3 align="center"><em>(Please <a href="signupc.php">re-enter</a> the data)</em></h3>
	<em align="center"><h3><a href="home.php">home</a></h3></em>
	</font>
<?php endif; ?>

</br>
<?php if ($flag==0): ?>
	<?php while($row=mysql_fetch_array($result)): ?>
		<font color="darkblue" size="4"><em><h3>	
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font>  <?php echo $row["name"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Father / Guardian</br></font>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font>  <?php echo $row["father_or_guardian_name"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Date of birth : </font><?php echo $row["dob"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">   Age &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </font><?php echo $row["age"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Mobile no &nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["mobile_no"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Email Id &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["email_id"]; ?></br>  
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Genger &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["gender"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	street &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["street"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Post &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["post"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	City &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["city"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Pincode &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["pincode"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	State &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["state"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Country &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:</font><?php echo $row["country"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Username &nbsp&nbsp&nbsp:</font> <?php echo $row["username"]; ?></br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<font color="green">	Password &nbsp&nbsp&nbsp&nbsp:</font> <?php $n=strlen($row["password"]);
						 for($i=0;$i<$n;$i++) 
							echo "*"; ?>
		</h3></em></font>	
	<?php endwhile; ?>

	<font color="green">
	<em align="center"><h3>Data entered successfully</h3></em>
	<em align="center"><h3><a href="home.php">home</a></h3></em>
	<?php mysql_close($link); ?>
	</font>
<?php endif; ?>

</form>
</body>
</html>
