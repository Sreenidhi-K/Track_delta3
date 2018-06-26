<?php

$host="localhost";
$dbuser="root";
$pass="";
$dbname="trackersite";
$conn=mysqli_connect($host,$dbuser,$pass,$dbname);
if(empty($_SESSION["un_ss"]))
{
    echo("Wrong Way !");
    die();
}
$uname=mysqli_real_escape_string($conn,$_REQUEST['uname']);
$data=mysqli_query($conn,"SELECT * FROM userslist where username='$uname'");
if(mysqli_num_rows($data)>0)
{
print "<span style=\"color:red;\">exists</span>";
}
else
{
print "<span style=\"color:greenyellow;\">available</span>";
}
?>