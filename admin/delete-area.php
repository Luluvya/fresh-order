<?php
    //Include Constants File
    include('../config/constants.php');
    
    //echo "Delete Page";
    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        //echo "Get Value and Delete";
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //Remove the physical image file is available
        if($image_name != "")
        {
            //Image is Available, so remove it
            $path = "../images/area/".$image_name;
            //Remove the Image
            $remove = unlink($path);
            
            //If failed to remove the image then add an error message and stop the process
            if($remove==false)
            {
                //Set the session message
                $_SESSION['remove'] = "<div class='error'>移除图片失败</div>";
                //Redirect to Manage Area page
                header('location:'.SITEURL.'admin/manage-area.php');
                //Stop the Process
                die();
            }
        }
        
        //Delete Dta from Database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_area WHERE id=$id";
        
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        
        //Check whether the data is deleted from database or not
        if($res==true)
        {
            //Set Success Message and Redirect
            $_SESSION['delete'] = "<div class='success'>删除产地成功</div>";
            //Redirect to manage area
            header('location:'.SITEURL.'admin/manage-area.php');
        }
        else
        {
            //Set Fail Message and Redirects
            $_SESSION['delete'] = "<div class='error'>删除产地失败</div>";
            //Redirect to manage area
            header('location:'.SITEURL.'admin/manage-area.php');
        }

        
    }
    else
    {
        //redirect to manage area page
        header('location:'.SITEURL.'admin/manage-area.php');
    }
?>