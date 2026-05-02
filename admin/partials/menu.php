<?php 
 
    include('../config/constants.php');
    include('login-check.php');

?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Fresh Order Website - Home Page</title>
        
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">主页</a></li>
                    <li><a href="manage-admin.php">用户</a></li>
                    <li><a href="manage-area.php">产地</a></li>
                    <li><a href="manage-product.php">生鲜</a></li>
                    <li><a href="manage-order.php">订单</a></li>
                    <li><a href="logout.php">注销</a></li>
                </ul>    
            </div>
        </div>
        <!-- Menu Section Ends -->
