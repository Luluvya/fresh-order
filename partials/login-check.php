<?php
    
    //Authorization - Access Control
    //Check whether the user is logged in or not
    if(!isset($_SESSION['user']))//If user session is not set
    {
        //User is not logged in
        //Redirect to Login Page with message
        $_SESSION['no-login-message'] = "<div class='error text-center'>请登录进入管理面板</div>";
        //Redirect to Login Page
        header('location:'.SITEURL.'admin/login.php');
    }
    
?>