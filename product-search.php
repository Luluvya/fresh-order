<?php include('partials-front/menu.php'); ?>

    <!-- Product Search Section Starts Here -->
    <section class="product-search text-center">
        <div class="container">
            <?php 
                //Get the Search Keyword
                $search = $_POST['search'];
                //$search = mysqli_real_escape_string($conn,$_POST['search']);

            ?>
            <h2>相关产品<a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Product Search Section Ends Here -->



    <!-- Product Menu Section Starts Here -->
    <section class="product-menu">
        <div class="container">
            <h2 class="text-center">产品列表</h2>
            <?php
                
                //SQL Query to Get products based on search keyword
                ////$serach = burger'
                //SELECT * FROM tbl_product WHERE title like '%%' or description like '%%'";
                $sql = "SELECT * FROM tbl_product WHERE title LIKE '%$search%' OR description LIKE '%search%'";
            
                //Execute the query
                $res = mysqli_query($conn,$sql);
                
                //Count Rows
                $count = mysqli_num_rows($res);
                
                //Check whether food available or not
                if($count>0)
                {
                    //Food Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                            <div class="product-menu-box">
                                <div class="product-menu-img">
                                    <?php
                                        //Check whether image name is available or not
                                    if($image_name=="")
                                    {
                                        //Image not available
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
                                    <p class="product-price">$<?php echo $price; ?></p>
                                    <p class="product-detail">
                                        <?php echo $description; ?>
                                    </p>
                                    <br>

                                    <a href="#" class="btn btn-primary">立即购买</a>
                                </div>
                            </div>
            
                        <?php
                                }
                            }
                            else
                            {
                                //Product not available
                                echo "<div class='error'>产品未找到</div>";
                            }
                        ?>
           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- Product Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>