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
    .inv_form
    {
            margin-top: 50px;
             letter-spacing: 50px;
            background-color:black; 
            padding: 10px;
            position: absolute;
            left: 5%;
            font-size: 30px; 
            color:pink;
    }
    #your_inv
    {
            
            background-color:black; 
            padding: 10px;
            position: absolute;
            right: 200px;
            top:30%;
            width:500px;
            font-size: 20px; 
            color:plum;
    }
    .details
    {
            margin-top: 200px;
            background-color:black; 
            padding: 10px;
            position: absolute;
            left: 20px;
            font-size: 30px; 
            width:500px;
            overflow: auto;
            color:dodgerblue;
            
    }
     .timings
    {
            margin-top: 200px;
            background-color:black; 
            padding: 10px;
            position: absolute;
            left: 5px;
            font-size: 30px; 
            color:greenyellow;
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
    input
    {
        width: 500px;
        background-color: pink;
        color: firebrick;
        font-size: 30px;
    }
    #add_inv
    {
        color:darkorchid;
        border-style: solid;
        border-color:purple;
        text-decoration: none;
    }
</style>
</head>
<body>

<form class="inv_form" action="invite_end.php" method="post">
    <span> INVITE: <br><br></span>
 <input name="iden" type='number' placeholder="Enter the appnt id (ex.1,10,24,...)">

<input name="rec" type="text" placeholder="Enter the receiver's username"> 
   
    <button type="submit" name="send_inv" style="letter-spacing:1px">SEND INVITE </button>

</form>

<?php 
    
 $name_user=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
 $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_user';");
    $rows=mysqli_fetch_row($some_res);
    $id_res=$rows[0];
$row=mysqli_query($conn,"SELECT * FROM appnt$id_res ORDER BY identity;");
if(mysqli_num_rows($row)==0)
{
    echo ( "<h4 class='details'> no list items yet </h4>");
}
else
    {
    while($avail=mysqli_fetch_assoc($row))
    {
    echo("<div class='timings'><b>(id-".$avail['identity'].") </b> ".$avail['dates']." :: ".$avail['st_time']." to ".$avail['end_time']."</div><br><br><br>");
    echo("<div class='details'>".$avail['title']." - ".$avail['descr']."</div><br><br><br><br> ");
   
    }
}
?>
<div id="your_inv">

Your invites: <br><br>



</div>

    <script type="text/javascript">
function upd()
    {
        req = new XMLHttpRequest();
        req.open("GET","select.php",false);
        req.send(null);
        document.getElementById('your_inv').innerHTML=req.responseText;
    }
    upd();
    setInterval(function(){
        upd();
    },2000);
    
</script>

</body>
</html>