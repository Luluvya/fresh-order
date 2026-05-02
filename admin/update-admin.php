<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>更新用户</h1>
        
        <br><br>
        
        <?php
            //1.Get the ID of Selected Admin
            $id=$_GET['id'];
            //2.Create SQL Query to Get the Details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";
            
            //Execute the Query
            $res=mysqli_query($conn,$sql);
            
            //Check whether the Query is Executed or not
            if($res==true)
            {
                //Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    //Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);
                    
                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>姓名：</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name;?>">
                    </td>
                </tr>
                
                <tr>
                    <td>昵称：</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username;?>">
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="更新用户" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    //if(isset($_POST['id']))    
    {
        //echo "Button Clicked";
        //Get all the values from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        
        //Create a SQL query to update admin
        $sql="UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id ='$id'
        ";
          
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        
        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query executed and admin updated
            $_SESSION['update'] = "<div class='success'>用户更新成功</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
             $_SESSION['update'] = "<div class='error'>用户更新失败</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
?>

<?php include('partials/footer.php');?>