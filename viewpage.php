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
?>
<html>
<head>
<title> View page </title>  
<style>
    body
    {
       background-image:url('block_mix.png');
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-size: cover;
        font-family: Century Gothic;
       
    }
    .details
    {
            margin-top: 100px;
            background-color:black; 
            padding: 10px;
            position: absolute;
            left: 40%;
            font-size: 30px; 
            color:dodgerblue;
    }
     .timings
    {
            margin-top: 100px;
            background-color:black; 
            padding: 10px;
            position: absolute;
            left: 20%;
            font-size: 30px; 
            color:greenyellow;
    }
    .date_id
    {
            margin-top: 10px;
            background-color:black; 
            padding: 10px;
            position: absolute;
            left: 30%;
            font-size: 50px; 
            color:palevioletred;
    }
    .vertical-text 
    {
	writing-mode: vertical-lr;
    text-orientation: upright;
     position: absolute;
    left: 10%;
    font-size: 70px;
     color:deeppink;
    background-color:black;
        
}
</style>
</head>
<body>
<div class="vertical-text">TIMELINE</div>
<?php

    if(empty($_GET['id']))
    {
        echo("Wrong way!");
        
    }
    else
    {
        $dates=$_GET['id']; 
 $name_user=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
 $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_user';");
$rows=mysqli_fetch_row($some_res);
$id_res=$rows[0];
$row=mysqli_query($conn,"SELECT * FROM appnt$id_res WHERE dates='$dates' ORDER BY st_time;");
echo("<div class='date_id'>".$dates."</div>");

if(mysqli_num_rows($row)==0)
{
    echo ( "<h4 class='details'> no list items yet </h4>");
}
else
    {
    
    while($avail=mysqli_fetch_assoc($row))
    {
        
    echo("<div class='timings'>".$avail['st_time']." to ".$avail['end_time']."</div>");
    echo("<div class='details'>".$avail['title']." - ".$avail['descr']."</div><br><br><br> ");
   
    }
}
    }
?>

</body>
</html>