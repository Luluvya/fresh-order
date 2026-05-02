<?php include('../config/constants.php');?>

<html>
    <head>
        <title>管理员登录-农心鲜生</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    
    <body>
        
        <div class="login">
            <h1 class="text-center">登录</h1>
            
            <br><br>
            <?php
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
                
                if(isset($_SESSION['no-login-message']))
                {
                     echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            
            <!-- Login Form Starts Here -->
            <form action="" method="POST" class="text-center">
            <h3>昵称：</h3><br>
            <input type="text" name="username" placeholder="输入昵称"><br><br>
            
            <h3>密码：</h3><br>
            <input type="password" name="password" placeholder="输入密码"><br><br>
            
            <input type="submit" name="submit" value="登录" class="btn-primary">
            <br><br>
            </form>
            <!-- Login Form Ends Here -->
            <p class="text-center">版权所有 - <a href="www.Zhai Danlan.com">Zhai Danlan</a></p>
        </div>
    </body>
</html>

<?php

    //Check whether the Submit Button is clicked or not
    if(isset($_POST['submit']))
    {
        //Process foe Login
        //1.Get the Data from Login form
        //$username = $_POST['username'];
        //$password = md5($_POST['password']);
        $username = mysqli_real_escape_string($conn,$_POST['username']);
        
        $raw_password = md5($_POST['password']);
        $password = mysqli_real_escape_string($conn,$raw_password);
        
        //2.SQL to check whether the username and password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";
           
        //3.Execute the Query
        $res = mysqli_query($conn,$sql);
        
        //4.Count rows to check whether the user exists or not
        $count = mysqli_num_rows($res);
        
        if($count==1)
        {
            //User Available and Login Success
            $_SESSION['login'] = "<div class='success'>管理员登录成功</div>";
            $_SESSION['user'] = $username;//To Check whether the user id logged in or not and logout will unset it
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            //User not Available
            $_SESSION['login'] = "<div class='error text-center'>用户名或密码错误</div>";
            //Redirect to Home Page/Dashboard
            header('location:'.SITEURL.'admin/login.php');
        }
    }
?>