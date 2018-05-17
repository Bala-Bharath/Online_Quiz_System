<html>

<head>
<title>Thanks you!</title>
</head>

<body background="exam6.jpg">
<form action=" signupc2.php" method="post" >
<?php $flag=0; ?>
<font color="red"><em>
<?php if (strlen($_POST["textField3"])!=10): ?>
	
	<h3>Invalid mobile number!</h3>
	<?php $flag=1; ?>
<?php endif; ?>


<?php if(!strstr($_POST["textField4"],"mail.com")): ?>
	<h3>Invalid Email Id!</h3>
	<?php $flag=1; ?>
<? endif; ?>

<?php if(strlen($_POST["textField8"])!=6): ?>
	<h3>Invalid Pincode!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if(strlen($_POST["passWord1"])<8): ?>
	<h3>Invalid Password!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if(strcmp($_POST["passWord1"],$_POST["passWord2"])): ?>
	<h3>Please confirm Password!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

<?php if(is_null($_POST["textField1"] || is_null($_POST["textField2"] || is_null($_POST["textField3"] || is_null($_POST["textField4"] || (is_null($_POST["radioButton1"] || is_null($_POST["radioButton2"]) ||
 is_null($_POST["textField5"] || is_null($_POST["textField6"] || is_null($_POST["textField7"] || is_null($_POST["textField8"] || is_null($_POST["textField9"] || is_null($_POST["textField10"] || is_null($_POST["textField11"] || is_null($_POST["passWord1"] || is_null($_POST["passWord2"])): ?>
	<h3>Don't enter null value!</h3>
	<?php $flag=1; ?>
<?php endif; ?>

</em></font>
<?php if ($flag==1): ?>
	<font color="green">
	<h3><em>(Please <a href="signupc.php">re-enter</a> the data)</em></h3>
	</font>
<?php endif; ?>


<?php
if ($flag==0)
{
$name=$_POST["textField1"];
$dob=$_POST["textField2"];
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
$sql="create table if not exists studentsdetails(name varchar(50) not null,dob date not null,mobile_no double not null,email_id varchar(50) not null,gender varchar(10) not null,street varchar(20) not null,post varchar(50) not null,city varchar(50) not null,pincode double not null,state varchar(50) not null,country varchar(50) not null,username varchar(50) not null,password varchar(20) not null,primary key(username),unique(email_id));";
mysql_query($sql)
	or die (mysql_error());


$sql="insert into studentsdetails values('$name','$dob','$mobileno','$emailid','$gender','$street','$post','$city','$pincode','$state','$country','$username','$password1')";

mysql_query($sql) or die ("Unable to insert :".mysql_error()."</br>");


$sql="select * from studentsdetails where mobile_no=$mobileno;";
$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");

}
?>
</br>
<?php if ($flag==0): ?>
<?php while($row=mysql_fetch_array($result)): ?>
	<font color="white" size=""><em><h3>	
	Name  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["name"]; ?></br>
	Date of birth : <?php echo $row["dob"]; ?></br>
	Mobile no &nbsp&nbsp&nbsp&nbsp: <?php echo $row["mobile_no"]; ?></br>
	Email Id &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["email_id"]; ?></br>  
	Genger &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo $row["gender"]; ?></br>
	street &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp:<?php echo $row["street"]; ?></br>
	Post &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["post"]; ?></br>
	City &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["city"]; ?></br>
	Pincode &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["pincode"]; ?></br>
	State &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["state"]; ?></br>
	Country &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <?php echo $row["country"]; ?></br>
	Username &nbsp&nbsp&nbsp: <?php echo $row["username"]; ?></br>
	Password &nbsp&nbsp&nbsp&nbsp: <?php $n=strlen($row["password"]);
						 for($i=0;$i<$n;$i++) 
							echo "*"; ?>
	</h3></em></font>	
<?php endwhile; ?>

	<font color="green">
	<h3><em>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspData entered successfully.<a href="home.php">home</a></em></h3>
	</font>
<?php endif; ?>
<?php if ($flag==0) mysql_close($link); ?>
</form>
</body>
</html>
