
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



<!-- Product Menu Section Starts Here -->
<section class="product-menu">
    <div class="container">
        <h2 class="text-center">产品列表</h2>
        
        <?php
        //Display Products that are active
        $sql = "SELECT * FROM tbl_product WHERE active='是'";
        
        //Execute the Query
        $res = mysqli_query($conn,$sql);
        
        //Count Rows
        $count = mysqli_num_rows($res);
        
        //Check whether the products are available or not
        if($count>0)
        {
            //Products Available
            while($row=mysqli_fetch_assoc($res))
            {
                //Get the values
                $id = $row['id'];
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
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
                            <p class="product-price">$<?php echo $price; ?></p>
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
            echo "<div class='error'>产品未找到</div>";
        }
            ?>

        



        <div class="clearfix"></div>

        

    </div>

</section>
<!-- Product Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

