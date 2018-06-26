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
        
        if(isset($_POST['send_inv']))
        {
         $iden=$_POST['iden'];
         $rec=mysqli_real_escape_string($conn,$_POST['rec']);
        $name_user=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
         
          
            if(empty($iden)||empty($rec))
            {
                echo("<h3>Empty field !</h3> ");
            }
            else
            {
              
             $sql_rec=mysqli_query($conn,"SELECT * FROM userslist WHERE username='$rec' AND username<>'$name_user';");
                if(mysqli_num_rows($sql_rec)==0)
                {
                    echo("<h3> Invalid user name (receiver)</h3>");
                }
                else
                {
             
              $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_user';");
                $rows=mysqli_fetch_row($some_res);
                $id_res=$rows[0];
                $res_sql="SELECT * FROM appnt$id_res WHERE identity='$iden';";
                $result=mysqli_query($conn,$res_sql);
                if(!$result)
                {
                    echo("<h3>Query failed !</h3> ");
                     
            
                }
                else
                {   
                    if(mysqli_num_rows($result)==0)
                    echo("<h3>Invalid appnt id number </h3>");
                    else
                    {
                        $avail=mysqli_fetch_assoc($result);
                        $app_tit=mysqli_real_escape_string($conn,$avail['title']);  
                        $app_desc=mysqli_real_escape_string($conn,$avail['descr']);   
                        $app_start=mysqli_real_escape_string($conn,$avail['st_time']);   
                        $app_end=mysqli_real_escape_string($conn,$avail['end_time']);    
                        $app_date=mysqli_real_escape_string($conn,$avail['dates']); 
                        $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$rec';");
                        $rows=mysqli_fetch_row($some_res);
                        $id_res=$rows[0];
                        
                        $res_sql="INSERT INTO inv$id_res (sender,title, dates, st_time, end_time, descr) VALUES('$name_user','$app_tit', '$app_date', '$app_start', '$app_end', '$app_desc');";
                        
                        $result=mysqli_query($conn,$res_sql); 
                        
                        echo("<h3> Success !! </h3>");
                    }
                    
                }
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