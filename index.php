<?php
session_start();
$link = mysqli_connect("localhost","root","","reg");

if(isset($_POST["submit"]))
{
    $name=$_POST["name"];
    $email=$_POST["email"];
    $pass=  md5($_POST["pass"]);
    $gen=$_POST["gen"];
    $hobby=$_POST["hobby"];
    $ho="";
    foreach ($hobby as $h)
    {
        if($ho=="")
        {
            $ho=$h;
        }
        else 
        {
        $ho.=",".$h;
        }
    }
    $dob=$_POST["dob"];
    $country=$_POST["country"];
    $image=$_FILES["img"]["name"];
    $message=$_POST["message"];
    if(!empty($image))
    {
        if($_POST["captcha_code"]==$_SESSION["captcha_code"])
        {
        $qry="insert into reg values(null,'$name','$email','$pass','$gen','$ho','$dob','$country','$image','$message')";
	$res=  mysqli_query($link, $qry) or die(mysqli_error($link));
            if(mysqli_affected_rows($link)==TRUE)
            {
                $error_message1 = 'Registration Successful';
                move_uploaded_file($_FILES["img"]["tmp_name"], "$image");
            }
            else
                $error_message1 = 'Reginstration Failed';
            }
        else 
        {
            $error_message = "captcha_code do not match";
        }
    }
    else {
        echo "<script> alert('Please select image file'); </script>";    
    }
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
        <title>registration</title>
        <link href="bootstrap.min.css" rel="stylesheet" />
        <script src="bootstrap.js" ></script>
        <script src="jquery.js"></script>
        <style>
            .captcha-input {
            background:#FFF url('captcha_code.php') repeat-y; 
            padding-left: 85px;
            }
</style>
        <script>
            function check()
            {
                var p = document.getElementById("pass").value;
                var cp = document.getElementById("cpass").value;
                if( p != cp )
                {
                    alert("password do not match ! ");
                }
                else 
                {
                    if(p.length<8)
                    {
                        alert("Please make your password long than 8 characters ! ");
                    }
                }
            }
        </script>
    </head>
    <body>
        <br />
        <form action="index.php" method="post" enctype="multipart/form-data">
            <div class="container">
            <h2 align="center" class="text-danger">Registration Form</h2>
            <div class="col-md-10 col-md-offset-1">
            <table class="table table-bordered table-striped">
                <?php
                
                    if(isset($error_message1))
                    {
                        echo "<tr><td colspan=2>$error_message1</td></tr>";
                    }
                    if(isset ($error_message))
                    {
                        echo "<tr><td colspan=2>$error_message</td></tr>";
                    }
                
                ?>
                <tr>
                    <td>Full Name</td>
                    <td><input type="text" id="name" class="form-control" name="name" placeholder="Enter Full Name" required /></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" id="email" class="form-control" name="email" placeholder="Enter Email Address" required /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" id="pass" name="pass" class="form-control" placeholder="Enter Password" required /></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" class="form-control" required id="cpass"  name="cpass" placeholder="Enter Passsword Again" /></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        For Male :- <input type="radio" id="gen" name="gen" value="M" required /><br>
                        For Female :- <input type="radio" id="gen" name="gen" value="F" required />
                    </td>
                </tr>
                <tr>
                    <td>Hobby</td>
                    <td>
                        Dance <input type="checkbox" id="hobby" name="hobby[]" value="Dance" /><br>
                        Driving <input type="checkbox" id="hobby" name="hobby[]" value="Driving" /><br>
                        Boxing <input type="checkbox" id="hobby" name="hobby[]"  value="Boxing" /><br>
                        Football <input type="checkbox" id="hobby" name="hobby[]" value="Football"  /><br>
                        Singing <input type="checkbox" id="hobby" name="hobby[]" value="Singing" />
                    </td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td><input type="date" id="dob" required class="form-control" name="dob" /></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>
                        <select name="country" class="form-control"> 
                            <option value="0">Select Country</option>
                            <option value="India">India</option>
                            <option value="America">America</option>
                            <option value="Afganistan">Afganistan</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Africa">Africa</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Image File</td>
                    <td><input type="file" id="img"  name="img" /></td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td><textarea name="message" class="form-control" placeholder="Message Type Here " required="" ></textarea></td>
                </tr>
                <td>Captcha code</td>
                <td>
                <input name="captcha_code" type="text"  class="form-control captcha-input">
                </td>

                <tr>
                    <td colspan="2">
                        <input type="submit" onclick="check()" id="submit" class="btn btn-primary" value="Register" name="submit" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="login.php" > Login Here </a>
                    </td>
                </tr>
                
            </table>
            </div>
            </div>
	</form>
        <script>
            $(document).ready(function(){
                $("#dob").click( function(){
                    //alert("focus lock");
                    $("#dob").datepicker();
                });
            });
        </script>
    </body>
</html>
