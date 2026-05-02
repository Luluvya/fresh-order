<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
          <h1>添加用户</h1>
        
          <br><br>
          
          <?php
            if(isset($_SESSION['add']))//Checking whether the Session is Set or not
            {
                echo $_SESSION['add'];//Display the Session Message if Set 
                unset($_SESSION['add']);//Removing Session Message
            }
          ?>
        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>姓名：</td>
                    <td><input type="text" name="full_name" placeholder="请输入姓名"></td>
                </tr>
                
                <tr>
                    <td>昵称：</td>
                    <td>
                        <input type="text" name="username" placeholder="请输入昵称">
                    </td>
                </tr>
                
                <tr>
                    <td>密码：</td>
                    <td>
                        <input type="password" name="password" placeholder="请输入密码">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="添加用户" class="btn-secondary">
                    </td>
                </tr>
            </table>
            
        </form>
            
        
    </div>
</div>
<?php include('partials/footer.php');?>

<?php 
    //Process the Value from Form and Save it in Database
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //Button Clicked
        //echo "Button Clicked";
        
        //1.Get the Data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);//Password Encryption with MD5
        
        //2.SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";    
        
        //3.Executing Query and Saving Data in Database 
        $res = mysqli_query($conn,$sql) or die(mysqli_error());
        
        //4.Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "添加用户成功";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Insert Data
            //echo "Failed to Insert Data";
             //Create a Session Variable to Display Message
            $_SESSION['add'] = "添加用户失败";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'admin/add-admin.php');
        }
    }
 
?>
