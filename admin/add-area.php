
<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>添加产地</h1>
        
        <br><br>
        
        <?php
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
        ?>
        
        <br><br>
        
        <!-- Add Area Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                <tr>
                    <td>名称：</td>
                    <td>
                        <input type="text" name="title" placeholder="产地名称">
                    </td>
                </tr>
                
                <tr>
                    <td>选择图片：</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>助农项目：</td>
                    <td>
                        <input type="radio" name="featured" value="是"> 是
                        <input type="radio" name="featured" value="否"> 否
                    </td>
                </tr>
                
                <tr>
                    <td>应季产品：</td>
                    <td>
                        <input type="radio" name="active" value="是"> 是
                        <input type="radio" name="active" value="否"> 否
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="添加产地" class="btn-secondary">
                    </td>
                </tr>
            </table>
            
        </form>
        <!-- Add Area Form Ends -->
        
        <?php 
            //Check whether the Submit Button is Clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                
                //1.Get the Value from Area Form
                $title = $_POST['title'];
                
                //For Radio input, we need to check whether the button is clicked or not
                if(isset($_POST['featured']))
                {
                    //Get the value from form
                    $featured = $_POST['featured'];
                }
                else
                {
                    //Set the Default Value
                    $featured = "No";
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];      
                }
                else
                {
                    $active = "No";
                }
                
                //Check whether the image is selected or not and set the values for image name accordingly
                //print_r($_FILES['image']);
                //die();//Break the Code Here
                
                if(isset($_FILES['image']['name']))
                {
                    //Upload the Image
                    //To upload image we need,source path and destination path
                    $image_name = $_FILES['image']['name'];
                    
                    //Upload the Image only if image is selected
                    if($image_name != "")
                    {
                        
                    
                        //Auto Rename our Image
                        //Get the Extension of our image (jpg,png,gif,etc) e.g. "specialfood1.jpg"
                        $ext = end(explode('.',$image_name));

                        //Rename the Image
                        $image_name = "Product-Area-".rand(000,999).'.'.$ext;//e.g. Product-Area-834.jpg


                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/area/".$image_name;

                        //Finally Upload the Image
                        $upload = move_uploaded_file($source_path,$destination_path);

                        //Check whether the image is uploaded or not
                        //And if the image is not uploaded then we will stop the process and redirect with error message
                        if($upload==false)
                        {
                            //Set message
                            $_SESSION['upload'] = "<div class='error'>图片上传失败</div>";
                            //Redirect to Add Area Page
                            header('location:'.SITEURL.'admin/add-area.php');
                            //Stop the Process
                            die();
                        }
                    }
                }
                else
                {
                    //Don't Upload Image and Set the Image_name value as blank
                    $image_name="";
                }
                //2.Create SQL Query to Insert Area into Database
                $sql = "INSERT INTO tbl_area SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";
                
                //3.Execute the Query and Save in Database
                $res = mysqli_query($conn,$sql);
                
                //4.Check whether the Query Executed or not and Data added or not
                if($res==true)
                {
                    //Query Executed and Area Added
                    $_SESSION['add'] = "<div class='success'>产地添加成功</div>";
                    //Redirect to Manage Area Page
                    header('location:'.SITEURL.'admin/manage-area.php');
                }
                else
                {
                    //Failed to Add Area
                     $_SESSION['add'] = "<div class='error'>产地添加失败</div>";
                    //Redirect to Manage Area Page
                    header('location:'.SITEURL.'admin/manage-area.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>