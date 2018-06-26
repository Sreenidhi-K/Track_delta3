<?php
session_start();
$host="localhost";
$dbuser="root";
$pass="";
$dbname="trackersite";
$conn=mysqli_connect($host,$dbuser,$pass,$dbname);
if(mysqli_connect_errno())
{
    echo("Connection failed");

}
if(empty($_GET['id']))
    {
        echo('Wrong way!');
        die();
    }
?>
<html>
<head>
<title> Add invites </title>    
<link rel="stylesheet" type="text/css" href="reg_style.css">
</head>
<body>
<?php
$iden=mysqli_real_escape_string($conn,$_GET['id']);    
 $name_user=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
 $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_user';");
$rows=mysqli_fetch_row($some_res);
$id_res=$rows[0];
$row=mysqli_query($conn,"SELECT * FROM inv$id_res WHERE invid='$iden';");
$avail=mysqli_fetch_assoc($row);
if(mysqli_num_rows($row)==0)
{
    echo ( "<h3> no list items yet </h3>");
}
else
    {
    $res_add=mysqli_query($conn,$sql_add);
    $res_del=mysqli_query($conn,"DELETE FROM inv$id_res WHERE invid='$iden';");
    header('Location: meeting.php');
    
   
    }

?>
</body>
</html>