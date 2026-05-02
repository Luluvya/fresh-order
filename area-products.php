
<?php include('partials-front/menu.php'); ?>

<?php
    //Check whether id is passed or not
    if(isset($_GET['area_id']))
    {
        //area id is set and get the id
        $area_id = $_GET['area_id'];
        //get the area title based on area id
        $sql = "SELECT title FROM tbl_area WHERE id=$area_id";
        
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        
        //Get the value from database
        $row = mysqli_fetch_assoc($res);
        //Get the Title
        $area_title = $row['title'];
    }
    else
    {
        //Area not passed
        //Redirect to Home Page
        header('location:'.SITEURL);
    }
?>
    <!-- Products Search Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            
            <h2><a class="text-white">相关产品</a></h2>

        </div>
    </section>
    <!-- Product Search Section Ends Here -->



    <!-- Product Menu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">产品列表</h2>
            <?php
                //Create SQL query to get products based on selected area
                $sql2 = "SELECT * FROM tbl_product WHERE area_id=$area_id";
            
                //Execute the Query
                $res2 = mysqli_query($conn,$sql2);
                
                //Count the Rows
                 $count2 = mysqli_num_rows($res2);
                
                //Check whether product is available or not
                if($count2>0)
                {
                    //Product is Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                            <div class="product-menu-box">
                                <div class="product-menu-img">
                                    <?php 
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
                                    <p class="product-price">$2.3</p>
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
                            //Product not available
                            echo "<div class='error'>产品不可用</div>";
                        }
                        ?>
     


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Product Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>