<html>

<head><title>Queastion & Answer page</title></head>

<body background="exam13.jpg">
<form action="" method="post">

<?php 
$mark=0;
$flag=0;

//database connectivity
$servername="localhost";
$user="root";
$password="";
$link=mysql_connect($servername,$user,$password)
	or die("Unable to connect Database :".mysql_error()."</br>");

//database selection
mysql_select_db("examdb",$link)
	or die("Can't select database :".mysql_error()."</br>");

$sql="select * from timeandmark;";
$result1=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");

if(mysql_num_rows($result1)>0)
{
	while($row=mysql_fetch_array($result1))
	{
	$edate=$row["exam_date"];
	$etime=$row["exam_time"];
	$eduration=$row["exam_duration"];
	$emark=$row["mark"];
	}
}

else
	$flag=1;

$eend=date("H:i:s",strtotime("$etime + $eduration mins"));
$stime=date("H:i:s");
$ctime=date("H:i:s",strtotime("$stime + 330 mins"));
$sdate=date("20y-m-d-H-i-s");
$cdate=date("20y-m-d", strtotime( "$sdate + 330 mins"));

//date_default_timezone_set("India/Chennai");
//echo "Date :".$edate."</br>"."Examtime :".$etime."</br>"."Examduration :".$eduration."</br>"."Mark :".$emark."</br>"."Exam endtime :".$eend."</br>";
//echo "Current date :".date("20y-m-d")."</br>";
//echo $stime;
//echo "current time :".$ctime;
//<?php ini_set('max_execution_time', ($eduration*60));
  
?>
<?php if ($edate==$cdate && $etime<=$ctime  && $eend>=$ctime): ?>
	<?php
	$sql="select * from questiondetails;";
	$result2=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
	$n=mysql_num_rows($result2);
	?>
	<em><h3>
	<?php if ($n>0): ?>
		<?php $k=0; $j=0; $i=0; $p=0; ?>
		<?php while ($row=mysql_fetch_array($result2)): ?>
			<?php $i++; ?>
			
			<?php $inc=$row["inc"]; ?>
			<?php if ($inc==1): ?>
				
				<?php
				$qno1=$row["question_no"];
				$k=1;
				?>
				</br></br>	
				<font color="darkblue" size="4">	
				<p align="center"><?php echo $qno1." : ".$row["question"]; ?></p></font>
				
				<font color="red" size="4">
				<p align="center"><?php echo "a) ".$row["choice1"]; ?></p>
				<p align="center"><?php echo "b) ".$row["choice2"]; ?></p>
				<p align="center"><?php echo "c) ".$row["choice3"]; ?></p>
				<p align="center"><?php echo "d) ".$row["choice4"]; ?></p>
				<font color="green">
				<p align="center"><label for="pullDownMenu">Answer option &nbsp&nbsp&nbsp&nbsp</label></font>
				<select name="pullDownMenu" id="pullDownMenu" size="1">
					<option value="">--select--</option>
					<option value="a">Choice 1</option>
					<option value="b">Choice 2</option>
					<option value="c">Choice 3</option>
					<option value="d">Choice 4</option>
				</select>&nbsp&nbsp&nbsp&nbsp
				<input type="image" name="imageField" id="imageField" value="" src=asterisk.gif width="15" height="15" /></p>
				<h3 align="center"><em><a href="studquespre.php">Previous</a>&nbsp&nbsp&nbsp<a href="studques.php">Next</a></em><h3>
				</h3></em>
				</br></br>
				<?php 
				$p=1;
				?>
			<?php endif; ?>
				
			<?php 
			if ($j==1)
			{
			$qno2=$row["question_no"]; 
			$j=0;
			}
			?>

			<?php
			if ($k==1)
			{
			$j=1;
			$k=0;
			}
			?>
			

		<?php endwhile; ?>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
				
	<?php else: ?>
		<?php $flag=1; ?>

	<?php endif; ?>
<?php else: ?>
	<?php $flag=1; ?>
<?php endif; ?>
<?php
$sql="update questiondetails set inc='0' where question_no='$qno1';";
$result3=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");	
	
$sql="update questiondetails set inc='1' where question_no='$qno2';";
$result4=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
?>

<?php if($flag==1): ?>
		</br></br>
		<font color="red" align="center" size="4"><em>
		<h3>1No question exist!</h3>
		<h3 align="center"><a href="home.php">Home</a></h3>
		</em></font>

<?php endif; ?>	

<?php
if ($flag!=1)
{
$answer=$_POST["pullDownMenu"];

$sql="create table if not exists lastmark(mark varchar(5) not null);";
		mysql_query($sql) or die (mysql_error());

$sql="insert into lastmark values('$answer');";
		mysql_query($sql) or die ("Unable to insert :".mysql_error()."</br>");


$sql="select * from lastuser;";
$result5=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
while($row=mysql_fetch_array($result5))
	{
	$username=$row["username"];
	}

$sql="update studentsdetails set mark='0' where username='$username';";
$result6=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
}
?>
<?php if ($flag!=1): ?>
	<?php if ($p!=1): ?>
	<h3 align="center"><em><a href="viewmark.php">Signout</a></em><h3>
	<?php endif; ?>
<?php endif; ?>
</form>
</body>
</html>