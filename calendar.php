<?php
//TO CHANGE THE MAX CHAR'S ALLOWED FOR DESCRIPTION etc.
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
 

// Set your timezone
date_default_timezone_set('Asia/Kolkata');
 
// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}
 
// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $timestamp = time();
}
 
// Today
$today = date('Y-m-j', time());
 
// For H3 title
$html_title = date('Y / m', $timestamp);
 
// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
 
// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
 
 
// Create Calendar
$weeks = array();
$week = '';
 
// Add empty cell
$week .= str_repeat('<td></td>', $str);
 
for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym.'-'.$day;   
    $idd=$date;
 $name_users=mysqli_real_escape_string($conn,$_SESSION["un_ss"]);
    $some_res=mysqli_query($conn,"SELECT id FROM userslist WHERE username='$name_users';");
    $rows=mysqli_fetch_row($some_res);
    $id_res=$rows[0];
    $row=mysqli_query($conn,"SELECT title FROM appnt$id_res WHERE dates='$idd';");
     
    if ($today == $date)
    {
        $week .= '<td class="today"><a href="viewpage.php?id='.$idd.'" >'.$day.'<br>';
        while($avail=mysqli_fetch_assoc($row))
        {
            $tit=$avail['title'];
        $week .='*'.$tit.'<br>';
   
        }
    } 
    else {
        $week .= '<td><a href="viewpage.php?id='.$idd.'">'.$day."<br>";
        while($avail=mysqli_fetch_assoc($row))
        {
            $tit=$avail['title'];
        $week .='*'.$tit.'<br>';
   
        }
    }
    $week .= '</a></td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {
         
        if($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }
         
        $weeks[] = '<tr>'.$week.'</tr>';
         
        // Prepare for new week
        $week = '';
         
    }
 
}
 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>PHP Calendar</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
    
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            position: absolute;
            width:auto;
            top: 100px;
            left:100px;
            background-color: black;
            color: greenyellow;
        }
        table
        {
              table-layout: fixed;
            
              
        }
        th {
            height: 30px;
            text-align: center;
            font-weight: 1000;
        }
        td {
            
                width:100px;
                height: 100px;
            overflow: hidden;
            text-overflow: ellipsis;
        
            
            
        }
        .today {
            background: white;
            color: darkgreen;
        }
        th:nth-of-type(7) a,td:nth-of-type(7) a {
            color: blue;
        }
        th:nth-of-type(1) a,td:nth-of-type(1) a {
            color: red;
        }
        label
        {
            color: white;
            letter-spacing: 1px;
        }
        #appoint
        {
          position: absolute;
            left:550px;
            top:20px;
            color: black;
            letter-spacing: 50px;
            padding:10px;
            background-color:black;
            width:600px;
        }
        #meet
        {
          position: absolute;
            left:550px;
            top:300px;
            font-size: 30px;
            letter-spacing: 5px;
            padding:10px;
            background-color:black;
            width:500px; 
        }
        h4
        {
           background-color:black; 
            padding: 10px;
            position: absolute;
            top: 1%;
            left: 35%;
            font-size: 50px; 
            color:dodgerblue;
        }
        td a{
            text-decoration: none;
            color: orange;
        }
        
    </style>
     
</head>
<body style="background-image:url('block_mix.png');background-repeat: no-repeat;background-attachment: fixed;background-position: center;background-size: cover;margin:10px;" >
    
    
    <?php
    //Welcome user statement
     if(!empty($_SESSION["un_ss"]))
     {
    echo "<h4>Welcome " . $_SESSION["un_ss"] . " !! </h4>";
    
    }
    else
    {
       header('Location: log_del3.php');
        echo "<h4> Wrong way </h4>";
        
    }
    ?>
    <a id="logout" href="logout_dest.php" style="background-color:black;margin:10px;font-size:30px;text-decoration:none;padding:10px"> LOGOUT </a>
    <div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <br>
        <table class="table table-bordered" style="width:500px">
            
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }   
            ?>
        </table>
        <form id="appoint" action="app_end.php" method="post">
            <label>ADD AN APPOINTMENT</label>
            <br><br>
        <label>TITLE:   </label><input type="text" placeholder="Title" name="app_tit">
        <label>DESCRIPTION:   </label><input type="text" placeholder="Description" name="app_desc">
        <br><br>
        <label>DATE:   </label><input type="date" placeholder="DATE" name="app_date">
        <label>START:   </label><input type="time" placeholder="start" name="app_start">
        <label>END:   </label><input type="time" placeholder="end" name="app_end">
        <br><br>
        <button type="submit" name="app_submit" style="letter-spacing:1px"> SUBMIT </button>
        </form>
        <a id="meet" href="meeting.php?id='true'"> Invite / Check invites </a>
    </div>

   
</body>
</html>