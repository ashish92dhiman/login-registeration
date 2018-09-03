<?php
session_start();
$link = mysqli_connect("localhost", "root" ,"" ,"reg");

if(isset($_POST["submit"]))
{
    $name=$_POST["user"];
    $pass=md5($_POST["pass"]);
    
    $qry="select * from reg where email='$name'";
    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
    $r =  mysqli_fetch_row($res);
    if($name==$r[2]  && $pass==$r[3])
    {
        //echo 'wellcome:-' .$r[1];
        $_SESSION["username"]="$name";
        header("location:profile.php");
    }
    else 
        $error_message = 'Invalid Username/Password';
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="bootstrap.min.css" rel="stylesheet" />
        <script src="jquery.js" ></script>
        <script src="bootstrap.js" ></script>
    </head>
    <body>
        <br>
        <form action="login.php" method="post" >
            <div class="container">
            <h2 align="center" class="text-danger">Login</h2>
            <div class="col-md-8 col-md-offset-2">
            <table class="table table-bordered">
                <?php
                
                    if(isset($error_message))
                    {
                        echo "<tr><td colspan=2>$error_message</td></tr>";
                    }
                
                ?>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="user" id="user" required placeholder="Enter usen name" class="form-control" /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pass" id="pass" required placeholder="Enter Password" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit" value="Login" class="btn btn-primary" /></td>
                </tr>
            </table>
            </div>
            </div>
        </form>
    </body>
</html>
