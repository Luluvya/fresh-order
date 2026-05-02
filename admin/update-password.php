<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>密码修改</h1>
        <br><br>
        
        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];
            }
        ?>
        
        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>原密码：</td>
                    <td>
                        <input type="password" name="current_password" placeholder="原密码">
                    </td>
                </tr>
           
            
                <tr>
                    <td>新密码：</td>
                    <td>
                        <input type="password" name="new_password" placeholder="新密码">
                    </td>
                </tr>
            
                <tr>
                    <td>确认密码：</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="确认密码">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="密码修改" class="btn-secondary">
                    </td>
                </tr>
            </table>  
        </form>
    </div>     
</div>

<?php

            //Check whether the Submit Button is clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                
                //1.Get the Data from Form
                $id=$_POST['id'];
                $current_password = md5($_POST['current_password']);
                $new_password = md5($_POST['new_password']);
                $confirm_password = md5($_POST['confirm_password']);
                
                //2.Check whether the user with current ID and Current Password Exists or Not
                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                
                //Execute the Query
                $res = mysqli_query($conn,$sql);
                
                if($res==true)
                {
                    //Check whether data is available or not
                    $count = mysqli_num_rows($res);
                    
                    if($count==1)
                    {
                        //User Exists and Password Can be Changed
                        //echo "User Found";
                        //Check whether the new password and confirm match or not
                        if ($new_password==$confirm_password)
                        {
                            //Update the Passord
                            //echo "Password Match";
                            $sql2 = "UPDATE tbl_admin SET
                                password='$new_password'
                                WHERE id=$id
                            ";
                            
                            //Execute the Query
                            $res2 = mysqli_query($conn,$sql2);
                            
                            //Check whether the query execute or not
                            if($res2==true)
                            {
                                //Display Success Message
                                //Redirect to Manage Admin Page with Error Message
                                $_SESSION['change-pwd'] = "<div class='success'>密码修改成功</div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Display Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>密码修改失败</div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //Redirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>密码不一致</div>";
                            //Redirect the User
                            header('location:'.SITEURL.'admin/manage-admin.php');
                        }
                    } 
                    else
                    {
                        //User Does not Exist Set Message and Redirect
                        $_SESSION['user-not -found'] = "<div class='error'>用户未找到</div>";
                        //Redirect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                //3.Check whether the New Password and Confirm Password Match or not
                
                //4.Change Password if all above is true
            }

?>

<?php include('partials/footer.php'); ?>