<?php
    //Include Constants Page
    include('../config/constants.php');
    //echo "Delete Product Page";

    if(isset($_GET['id']) && isset($_GET['image_name']))//Either use '&&' or 'AND'
    {
        //Process to Delete
        //echo "Process to Delete";
        
        //1. Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        
        //2.Remove the Image if Available
        //Check whether the image is available or not and delete only if available
        if($image_name != "")
        {
            //Id has Image and need to remove from folder
            //Get the image path
            $path = "../images/product/".$image_name;
            
            //Remove Image File from Folder
            $remove = unlink($path);
            
            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to remove image
                $_SESSION['upload'] = "<div class='error'>图片移除失败</div>";
                //Redirect to Manage Product
                header('location:'.SITEURL.'admin/manage-product.php');
                //Stop the Process of Deleting Product
                die();
            }
        }
        
        //3.Delete Product from Database
        $sql = "DELETE FROM tbl_product WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        
        //Check whether the query executed or not and set the session message respectively
        //4.Redirect to Manage Product with Session Message
        if($res==true)
        {
            //Product Deleted
            $_SESSION['delete'] = "<div class='success'>产品删除成功</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }
        else
        {
            //Failed to Delete Product
            $_SESSION['delete'] = "<div class='error'>产品删除失败</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }
        
        echo "Process to Delete";
    }
    else
    {
        //Redirect to Manage Product Page
        //echo "Redirect";
        $_SESSION['unauthorize'] = "<div class='error'>未经授权的访问</div>";
        header('location:'.SITEURL.'admin/manage-product.php');
    }
?>