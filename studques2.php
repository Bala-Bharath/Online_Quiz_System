
<html>

<head><title>Queastion & Answer page</title></head>

<body background="exam13.jpg">
<form action=" " method="post">

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
$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");

if(mysql_num_rows($result)>0)
{
	while($row=mysql_fetch_array($result))
	{
	$edate=$row["exam_date"];
	$etime=$row["exam_time"];
	$eduration=$row["exam_duration"];
	$emark=$row["mark"];
	}
}

else
	$flag=1;
$eend=date("H:i:s", strtotime( "$etime + $eduration mins")) ;

//echo "Hi"."</br>".$edate."</br>".$etime."</br>".$eduration."</br>".$mark."</br>".$eend;
//echo date("20y-m-d");
?>


<?php ini_set('max_execution_time', ($eduration*60)); ?>

<?php if ($edate==date("20y-m-d") && $etime<=date("H:i:s") && $eend>=date("H:i:s")): ?>

	<?php
	$sql="select * from questiondetails;";
	$result=mysql_query($sql) or die("Unable to select :".mysql_error()."</br>");
	$n=mysql_num_rows($result);
	//echo $result;
	?>

	<?php if ($n>0): ?>
		<?php $i=0; ?>
		<?php while ($row=mysql_fetch_array($result)): ?>
			<em><h3>
			<?php if ($row["inc"]==1): ?>
				<?php
				$k=1;
				$qno=$row["question_no"];
				$sql="update questiondetails set inc='0' where question_no='$qno';";
				$result=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
				?>

				<font color="darkblue" size="4">	
				<?php echo $qno." : ".$row["question"]; ?></font></br>
				
				<font color="red" size="4">
				&nbsp&nbsp
				<?php echo "a) ".$row["choice1"]; ?></br>&nbsp&nbsp
				<?php echo "b) ".$row["choice2"]; ?></br>&nbsp&nbsp
				<?php echo "c) ".$row["choice3"]; ?></br>&nbsp&nbsp
				<?php echo "d) ".$row["choice4"]; ?></br>

				<label for="pullDownMenu">Answer option &nbsp&nbsp&nbsp&nbsp</label>
				<select name="pullDownMenu" id="pullDownMenu" size="1">
					<option value="" selected="selected">--select--</option>
					<option value="a">Choice 1</option>
					<option value="b">Choice 2</option>
					<option value="c">Choice 3</option>
					<option value="d">Choice 4</option>
				</select>
				
				<input type="image" name="imageField" id="imageField" value="" src=asterisk.gif width="15" height="15" />
					
				<?php $ans=$row["answer"]; ?>

				</h3></em>
				</br></br>
								
				<?php 
				$j=1;	
				echo $answer=$_POST["pullDownMenu"];
				if($ans==$answer)
				{
				echo "right";
				$mark=$mark+1;
				$m=1;
				}
				?>
		<?php endif; ?>

		<?php if ($j==2): ?>
		<?php
		$qno=$row["question_no"];
		$sql="update questiondetails set inc='1' where question_no='$qno';";
		$result=mysql_query($sql) or die("Unable to update :".mysql_error()."</br>");
		?>
		<?php endif; ?>

		<?php $j++; ?>
		<?php endwhile; ?>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		
	<?php else: ?>
		$flag=1;

	<?php endif; ?>
	
	
	
<?php endif; ?>

<?php if ($k==1): ?>
</br></br>
		<font align="center" size="4"><em>
		<h3><a href="studques.php">Next</a></h3>
		</em></font>

<?php endif; ?>

<?php if($flag==1): ?>
		</br></br>
		<font color="red" align="center" size="4"><em>
		<h3>No question exist!</h3>
		</em></font>

<?php endif; ?>	

<?php if ($m==1): ?>
	<font color="green" size="4">
	<h3 align="center"><em>Your mark is <?php
						$tmark=$mark*$emark;	 
						echo $tmark; ?></em></h3></font>
<?php endif; ?>

</form>
</body>
</html>