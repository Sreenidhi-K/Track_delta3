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
    <title> login_track </title>
    <link rel="stylesheet" type="text/css" href="reg_style.css">
    </head>
    
    <body>
    
        <?php
        
        if(isset($_POST['login']))
        {
          $name_user=mysqli_real_escape_string($conn,$_POST['user_name']);  
          $pwd=mysqli_real_escape_string($conn,$_POST['pwd']);
          $encrypt_pwd=md5($pwd);
          $res = mysqli_query($conn,"SELECT * FROM userslist WHERE username='$name_user' AND pass='$encrypt_pwd'");
             if(mysqli_num_rows($res)==1)
             {
                 
                 $_SESSION["un_ss"] =$_POST['user_name'];
                 $_SESSION["pw_ss"] = md5($_POST['pwd']);
                  
                 
                 header("Location: calendar.php");
             }
            else
            {
                echo("<h3> Login Unsuccessful ! </h3>");
            }
        
        }
        
        else
        {
            echo("Wrong way !");
        }
        ?>

    </body>
</html>