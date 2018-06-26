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
    <title> Appointments add  </title>
    <link rel="stylesheet" type="text/css" href="reg_style.css">
    </head>
    
    <body>
    
        <?php
        
        if(isset($_POST['app_submit']))
        {
          $app_tit=mysqli_real_escape_string($conn,$_POST['app_tit']);  
         $app_desc=mysqli_real_escape_string($conn,$_POST['app_desc']);  
        $app_start=mysqli_real_escape_string($conn,$_POST['app_start']);  
        $app_end=mysqli_real_escape_string($conn,$_POST['app_end']);  
        $app_date=mysqli_real_escape_string($conn,$_POST['app_date']);  
          
            if(empty($app_tit)||empty($app_desc)||empty($app_start)||empty($app_end)||empty($app_date))
            {
                echo("<h3>Empty field !</h3> ");
            }
            else
            {
                $name_user=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
              $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_user';");
                $rows=mysqli_fetch_row($some_res);
                $id_res=$rows[0];
                $res_sql="INSERT INTO appnt$id_res (title, dates, st_time, end_time, descr) VALUES('$app_tit', '$app_date', '$app_start', '$app_end', '$app_desc');";
                $result=mysqli_query($conn,$res_sql);
                if(!$result)
                {
                    echo("<h3>Query failed !</h3> ");
                     
            
                }
                else
                {
                    echo("<h3>Appointment added successfully !!</h3>");
                    
                }
        }
        }
         
        else
        {
            echo("Wrong way !");
        }
        ?>

    </body>
</html>