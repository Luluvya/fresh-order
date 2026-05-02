<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
       <h1>产地管理</h1>
       
       <br /><br /><br />
        <?php
        
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['no-area-found']))
            {
                echo $_SESSION['no-area-found'];
                unset($_SESSION['no-area-found']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
       <br><br>
       
             <!--Button to Add Admin -->
             <a href="<?php echo SITEURL;?>admin/add-area.php" class="btn-primary">添加产地</a>
             <br /><br /><br />
            
             <table class="tbl-full">
                 <tr>
                     <th>序号</th>
                     <th>名称</th>
                     <th>图片</th>
                     <th>助农项目</th>
                     <th>应季产品</th>
                     <th>操作</th>
                 </tr>
                 
                 <?php
                 
                    //Query to Get all Area from Database
                    $sql = "SELECT * FROM tbl_area";
                    
                    //Execute Query
                    $res = mysqli_query($conn,$sql);
                    
                    //Count Rows
                    $count = mysqli_num_rows($res);
                    
                    //Create Serial Number Variable and assign value as 1
                    $sn=1;
                    
                    //Check whether we have data in database or not
                    if($count>0)
                    {
                        //We have data in database
                        //get the data and display
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            $featured = $row['featured'];
                            $active = $row['active'];
                            
                            ?>
                                <tr>
                                  <td><?php echo $sn++; ?>. </td>
                                  <td><?php echo $title; ?></td>
                                  
                                  <td>
                                      <?php  
                                        //Check whether image name is available or not
                                      if($image_name!="")
                                      {
                                          //Display the Image
                                          ?>
                                      
                                      <img src="<?php echo SITEURL;?>images/area/<?php echo $image_name; ?>" width="100px" >
                                 
                                      <?php
                                      }
                                      else
                                      {
                                          //Display the Message
                                          echo "<div class='error'>图片添加失败</div>";
                                      }
                                      ?>
                                  </td>
                                  
                                  <td><?php echo $featured;?></td>
                                  <td><?php echo $active;?></td>
                                  <td>
                                      <a href="<?php echo SITEURL; ?>admin/update-area.php?id=<?php echo $id; ?>" class="btn-secondary">更新产地</a>
                                      <a href="<?php echo SITEURL; ?>admin/delete-area.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">删除产地
                                  </td>
                                </tr>  
                            <?php
                            
                            
                        }
                    }
                    else
                    {
                        //We do not have data
                        //We'll display the message inside table
                        ?>
                 
                 <tr>
                     <td colspan="6"><div class="error">产地未添加</div></td> 
                 </tr>
                 
                 <?php
                    }
                 ?>
                 
                 
                  
             </table>
</div>
<?php include('partials/footer.php');?>
