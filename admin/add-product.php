<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>添加产品</h1>
        
        <br><br>
        
        <?php
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            
            <table class="tbl-30">
                
                <tr>
                    <td>名称：</td>
                    <td>
                        <input type="text" name="title" placeholder="产品名称">
                    </td>
                </tr>
                
                <tr>
                    <td>详情：</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="产品描述"></textarea>        
                    </td>
                </tr>
                
                <tr>
                    <td>价格：</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                
                <tr>
                    <td>选择图片：</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                
                <tr>
                    <td>产地：</td>
                    <td>
                        <select name="area">
                            
                            <?php
                                //Create PHP Code to display areas feom Database
                                //1.Create SQL to get all active areas from database
                                $sql = "SELECT * FROM tbl_area WHERE active='是'";
                                
                                //Executing query
                                $res = mysqli_query($conn,$sql);
                                
                                //Count Rows to Check whether we have areas or not
                                $count = mysqli_num_rows($res);
                                
                                //If count is greater than zero, we have areas else we donot have areas
                                if($count>0)
                                {
                                    //We have Areas
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of areas
                                        $id = $row['id'];
                                        $title = $row['title'];
                                        
                                        ?>
                            
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                        
                                        <?php
                                    }
                                }
                                else
                                {
                                    //We do not have area
                                    ?>
                                    <option value="0">未找到此基地</option>
                                    <?php
                                }
                                
                                //2.Display on Drpopdown
                            ?>
                           
                        </select>
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
                        <input type="submit" name="submit" value="添加产品" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        
        
        <?php
        
            //Check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1.Get the Data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $area = $_POST['area'];
                
                //Check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "否";//Setting the Default value
                }
                
                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "否";//Setting Default Value
                }
                
                //2.Insert Into Database
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the detailes of the selected image
                    $image_name = $_FILES['image']['name'];
                    
                    //Check whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //Imahge is Selected
                        //A.Rename the image
                        //Get the extension of selected image (jpg,png,gif,etc.)
                        $ext = end(explode('.',$image_name));
                        
                        //Create New Name for Image
                        $image_name = "Product-Name-".rand(0000,9999).".".$ext;//New Image Name May Be "Product-Name-1235.jpg"
                        
                        //B.Upload the Image
                        //Get the src path and destination path
                        
                        //Source path is the current location of the image
                        $src=$_FILES['image']['tmp_name'];
                        
                        //Destination Path for the image to be uploaded
                        $dst = "../images/product/".$image_name;
                        
                        //Finally upload the product image
                        $upload = move_uploaded_file($src,$dst);
                        
                        //Check whether image uploaded or not
                        if($upload==false)
                        {
                            //Failed to upload the image
                            //Redirect to add product page with error message
                            $_SESSION['upload'] = "<div class='error'>上传图片失败</div>";
                            header('location:'.SITEURL.'admin/add-product.php');
                            //stop the process
                            die();
                        }
                    }
                }
                else
                {
                    $image_name = "";//Setting Default Value as blank
                }
                
                //3.Insert Into Databse
                
                //Create a SQL query to save or add product
                //For numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO tbl_product SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    area_id = $area,
                    featured = '$featured',
                    active = '$active'
                ";
                
                //Execute the Query
                $res2 = mysqli_query($conn,$sql2);
                //Check whether data inserted or not
                
                if($res2 == true)
                {
                    //Data inserted successfully
                    $_SESSION['add'] = "<div class='success'>产品添加成功</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
                else
                {
                    //Failed to insert data
                    $_SESSION['add'] = "<div class='error'>产品添加失败</div>";
                    header('location:'.SITEURL.'admin/manage-product.php');
                }
                //4.Redirect with Message to Manage Product Page
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>
