<?php include('partials-front/menu.php'); ?>

    <!-- Product Search Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>product-search.php" method="POST">
                <input type="search" name="search" placeholder="搜索产品.." required>
                <input type="submit" name="submit" value="搜索" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- Product Search Section Ends Here -->
    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>
    <!-- Areas Section Starts Here -->
    <section class="areas">
        <div class="container">
            <h2 class="text-center">发现产品</h2>
            
            <?php
                //Create SQL Query to Display Areas from Database
                $sql = "SELECT * FROM tbl_area WHERE active ='是' AND featured='是' LIMIT 6";
                //Execute the query
                $res = mysqli_query($conn,$sql);
                //Count rows to check whether the area is available or not        
                $count = mysqli_num_rows($res);
                
                if($count>0)
                {
                    //Areas Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the values like title,id,image_name
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                   <a href="<?php echo SITEURL; ?>area-products.php?area_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                //Check whether Image is available or not
                                if($image_name=="")
                                {
                                    //Display Message
                                    echo "<div class='error'>图片不可用</div>";
                                }
                                else
                                {
                                    //Image Available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/area/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php  echo $title; ?></h3>
                        </div>
                        </a>
            
                        <?php
                    }
                }
                else
                {
                    //Areas not available
                    echo "<div class='error'>产地未添加</div>";
                }
            ?>
            
     

       

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Areas Section Ends Here -->

    <!-- Product Menu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">产品列表</h2>
            
            <?php
            
            //Getting Products from Database that are active and features
            //SQL Query
            $sql2 = "SELECT * FROM tbl_product WHERE active='是' AND featured='是' LIMIT 6";
            
            //Execute the Query
            $res2 = mysqli_query($conn,$sql2);
            
            //Count Rows
            $count2 = mysqli_num_rows($res2);
            
            //Check whether product available or not
            if($count2>0)
            {
                //Product Available
                while($row=mysqli_fetch_assoc($res2))
                {
                    //Get all the values
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>
                    <div class="product-menu-box">
                         <div class="product-menu-img">
                             <?php
                                //Check whether image available or not
                             if($image_name=="")
                             {
                                 //Image not Available
                                 echo "<div class='error'>图片不可用</div>";
                             }
                             else
                             {
                                 //Image Available
                                 ?>
                                 <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" class="img-responsive img-curve">
                             <?php
                             }
                             ?>
                            
                    </div>

                        <div class="product-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="product-price">￥<?php echo $price; ?></p>
                            <p class="product-detail">
                                <?php echo $description; ?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL; ?>order.php?product_id=<?php echo $id; ?>" class="btn btn-primary">立即购买</a>
                        </div>
                    </div>

            <?php
            
                }
            }
            else
            {
                //Product not Available
                echo "<div class='error'>产品不可用</div>";
            }
            ?>
    
          
            


            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">浏览全部</a>
        </p>
    </section>
    <!-- Product Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

    