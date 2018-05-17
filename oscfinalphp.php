<?php

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

?>