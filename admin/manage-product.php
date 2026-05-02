<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
       <h1>产品管理</h1>
       
       <br /><br /><br />
             <!--Button to Add Admin -->
             <a href="<?php echo SITEURL; ?>admin/add-product.php" class="btn-primary">添加产品</a>
             <br /><br /><br />
            
             <?php
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                
                if(isset($_SESSION['delete']))
                {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                
                if(isset($_SESSION['unauthorize']))
                {
                    echo $_SESSION['unauthorize'];
                    unset($_SESSION['unauthorize']);
                }
                
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
             ?>
             <table class="tbl-full">
                 <tr>
                     <th>序号</th>
                     <th>名称</th>
                     <th>价格</th>
                     <th>图片</th>
                     <th>助农项目</th>
                     <th>应季产品</th>
                     <th>操作</th>
                 </tr>
                 
                 <?php
                    //Create a SQL Query to Get all the Product
                 $sql = "SELECT * FROM tbl_product";
                 
                 //Execute the query
                 $res = mysqli_query($conn,$sql);
                 
                 //Count Rows to Check whether we have products or not
                 $count = mysqli_num_rows($res);
                 
                 //Create serial number variable and set default value as 1
                 $sn=1;
                 
                 if($count>0)
                 {
                     //We have product in database
                     //Get the product from database and display
                     while($row=mysqli_fetch_assoc($res))
                     {
                         //get the values from individual colums
                         $id = $row['id'];
                         $title = $row['title'];
                         $price = $row['price'];
                         $image_name = $row['image_name'];
                         $featured = $row['featured'];
                         $active = $row['active'];
                         ?>
                            <tr>
                               <td><?php echo $sn++; ?>. </td>
                               <td><?php echo $title; ?></td>
                               <td><?php echo $price; ?></td>
                               <td>
                                   <?php 
                                    //Check whether we have image or not
                                   if($image_name=="")
                                   {
                                       //We do not have image,Display error message
                                       echo "<div class='error'>图片未添加</div>";
                                       
                                   }
                                   else
                                   {
                                       //We have image,display image
                                       ?>
                                   <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" width="100px">
                                   <?php
                                   }
                                   ?>
                               </td>
                               <td><?php echo $featured; ?></td>
                               <td><?php echo $active; ?></td>
                               <td>
                                   <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btn-secondary">更新产品</a>
                                   <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">删除产品</a>
                               </td>
                           </tr>
                 
                        <?php
                     }
                 }
                 else
                 {
                     //Food not added in database
                     echo "<tr><td colspan='6' class='error'>产品未添加</td></tr>";
                   
                 }
                 ?>
                
                 
             </table>
</div>
<?php include('partials/footer.php');?>
