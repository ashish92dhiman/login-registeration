<?php
session_start();
if(isset($_POST["user"]))
{
    unset($_SESSION["username"]);
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
        <title>profile</title>
        <link href="bootstrap.min.css" rel="stylesheet" >
    </head>
    <body>
        <form action="profile.php" method="post" >
            <div class="container">
            <h2 align="center" class="text-justify">User Profile</h2>
            <?php
            $link=mysqli_connect("localhost","root","","reg");
                if(isset($_SESSION["username"]))
                {
                    $email = $_SESSION["username"];
                    $qry="select *  from reg where email='$email'";
                    $res=  mysqli_query($link, $qry) or die(mysqli_error($link));
                    if(mysqli_affected_rows($link)==TRUE)
                    {
                        $r =  mysqli_fetch_row($res);
                        //echo '<pre>';
                        //print_r($r);
                        $output[] = "<table class='table table-bordered'>";
                        $output[] = "<tr>";
                        $output[] = "<td><img src=$r[8] alt='iamge file' height='200px' width='200px' ></td>";
                        $output[] = "<td>";
                        $output[] = "NAME :- $r[1]<br>";
                        $output[] = "Email :- $r[2]<br>";
                        $output[] = "Gender :- $r[4]<br>";
                        $output[] = "Hobby :- $r[5]<br>";
                        $output[] = "Date of Birth :- $r[6]<br>";
                        $output[] = "Country :- $r[7]<br>";
                        $output[] = "Message :- $r[9]";
                        $output[] = "</tr>";
                        $output[] = "</table>";
                        echo join($output);
                    }
                }
                else 
                {
                    header("location:login.php");
                }
            
            ?>
            <input type="submit" name="user" class="btn btn-primary" value="Logout " />
            </div>
        </form> 
    </body>
</html>
