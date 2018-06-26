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
if(empty($_SESSION["un_ss"]))
{
    echo("Wrong Way !");
    die();
}
   
 $name_user=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
 $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_user';");
    $rows=mysqli_fetch_row($some_res);
    $id_res=$rows[0];
$row=mysqli_query($conn,"SELECT * FROM inv$id_res ;");
if(mysqli_num_rows($row)==0)
{
    echo ( "<span> no invites yet </span>");
}
else
    {
    while($avail=mysqli_fetch_assoc($row))
    {
    echo("<span> <a  href='add_inv_end.php?id=".$avail['invid']."' id='add_inv'> ADD </a><a  href='cancel_inv_end.php?id=".$avail['invid']."' id='add_inv'> CANCEL </a><br> ".$avail['sender']."<br>".$avail['dates']." :: ".$avail['st_time']." to ".$avail['end_time']." <br>".$avail['title']." ---- ".$avail['descr']."</span><br><br>");
   
    }
}
?>
