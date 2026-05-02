<?php include('partials/menu.php'); ?>

<?php
    //Check whether id is set or not
if(isset($_GET['id']))
{
    //Get all the details
    $id = $_GET['id'];
    
    //SQL Query to Get the Selected Food
    $sql2 = "SELECT * FROM tbl_product WHERE id=$id";
    //execute the query
    $res2 = mysqli_query($conn,$sql2);
    
    //Get the value based on query executed
    $row2 = mysqli_fetch_assoc($res2);
    
    //Get the Individual Values of Selected Food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_area = $row2['area_id'];
    $featured = $row2['featured'];
    $active = $row2['active'];
    
}
else
{
    //Redirect to Manage Product
    header('location:'.SITEURL.'admin/manage-product.php');
}

?>

<div class="main-content">
    <div class="wrapper">
        <h1>产品更新</h1>
        <br><br>
        
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                
                <tr>
                    <td>名称：</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>详情：</td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td>价格：</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>原图：</td>
                    <td>
                        <?php
                            if($current_image == "")
                            {
                                //Image not Available
                                echo "<div class='error'>图片不可用</div>";
                            }
                            else
                            {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $current_image; ?>" width="150px">
                        <?php
                            }
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td>上传新图：</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>产地：</td>
                    <td>
                        <select name="area">
                            
                            <?php
                                //Query to Get Active Areas
                                $sql = "SELECT * FROM tbl_area WHERE active='Yes'";
                                //Execute the Query
                                $res = mysqli_query($conn,$sql);
                                //Count Rows
                                $count = mysqli_num_rows($res);
                                
                                //Check whether area available or not
                                if($count>0)
                                {
                                    //Category Available
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $area_title = $row['title'];
                                        $area_id = $row['id'];
                                       
                                    //echo "<option value='$area_id'>$area_title</option>";
                                        ?>
                            <option <?php if($current_area==$area_id){echo "selected";} ?> value="<?php echo $area_id; ?>"><?php echo $area_title; ?></option>
                            <?php
                                    }
                                }        
                                else
                                {
                                    //Area not Available
                                    echo "<option value='0'>产地不可选</option>";
                                }
                            ?>
 
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>助农项目：</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="是"> 是
                        <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="否"> 否
                    </td>
                </tr>
                
                 <tr>
                    <td>应季产品：</td>
                    <td>
                        <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="是"> 是
                        <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="否"> 否
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        
                        <input type="submit" name="submit" value="产品更新" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>
        
        <?php
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";
                
                //1.Get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $area = $_POST['area'];
                
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                //2.Upload the image if selected
                
                //Check whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload Button Clicked
                    $image_name = $_FILES['image']['name'];//New Image Name
                    
                    //Check whether the file is available or not
                    if($image_name!="")
                    {
                        //Image is available
                        ////A.Uploading New Image
                        
                        //Rename the image
                        $ext = end(explode('.',$image_name));
                        
                        $image_name = "Product-Name-".rand(0000,9999).'.'.$ext;//This will be renamed image
                        
                        //Get the Source Path and Destination Path
                        $src_path = $_FILES['image']['tmp_name'];//Source Path
                        $dest_path = "../images/product/".$image_name;//Destination Path
                        
                        //Upload the Image
                        $upload = move_uploaded_file($src_path, $dest_path);
                        
                        //Check whether the image is uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload
                            $_SESSION['upload'] = "<div class='error'>图片上传失败</div>";
                            //Redirect to mANAGE fOOD
                            HEADER('location:'.SITEURL.'admin/manage-product.php');
                            //Stop the Process
                            die();
                        }
                        //3.Remove the image if new image is uploaded and current image exists
                        //B.Remove current Image if Available
                        if($current_image!="")
                        {
                            //Current Image is Available
                            //Remove the Image
                            $remove_path = "../images/product/".$current_image;
                            
                            $remove = unlink($remove_path);
                            
                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //Failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'>图片移除失败</div>";
                                //redirect to manage product
                                header('location:'.SITEURL.'admin/manage-product.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                       $image_name = $current_image;//Default Image when Image is not selected. 
                    }
                }
                else
                {
                    $image_name = $current_image;
                }
                
                
                //4.Update the Food in Database
                $sql3 = "UPDATE tbl_product SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    area_id = '$area',
                    featured = '$featured',
                    active = '$active'
                    WHERE id=$id
                ";
                
                //Execute the SQL Query
                $res = mysqli_query($conn,$sql3);
                
                //Check whether the query is executed or not
                if($res==true)
                {
                    //Query Executed and Food Updated
                    $_SESSION['update'] = "<div class='success'>产品更新成功</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>产品更新失败</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
            
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>