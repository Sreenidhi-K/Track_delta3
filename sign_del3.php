<!DOCTYPE html>
<html>
<head>
<title>Track !</title>  
<link rel="stylesheet" type="text/css" href="reg_style.css">
</head>

<body>
    <h1>Track !</h1>
    <form class="sign_up_with" action="sign_end.php" method="post">
        
        <h2> SIGN UP </h2>
    <input type="text" name="first_n" placeholder=" Your Name" >
        <br>
    <input type="text" name="userName" placeholder="User name(must be unique)" id='uname' >
        <span id='status'></span>
    
        <br>
    <input type="email" name="email_id" placeholder="Email ID" >
        <br>
     <input type="password" name="pass_word" placeholder="Password">
        <br>
      <input type="password" name="con_pass_word" placeholder="Confirm password">
        <br>
        
    <button type="submit" name="sign_submit"> SIGN UP </button>
        
    </form>
    <a type="button" name="login" id="log_log" href="log_del3.php" > LOG IN </a>
    
    
    <script type="text/javascript">
document.getElementById("uname").onblur = function() {
var xmlhttp;
var uname=document.getElementById("uname");
if (uname.value != "")
{
xmlhttp=new XMLHttpRequest();
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("status").innerHTML=xmlhttp.responseText;
}
};
    console.log(uname.value);
xmlhttp.open("GET","check_user.php?uname="+encodeURIComponent(uname.value),true);
xmlhttp.send();
}
};
</script>
     
</body>
</html>