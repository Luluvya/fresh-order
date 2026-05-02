<?php include('partials-front/menu.php'); ?>



    <!-- Areas Section Starts Here -->
    <section class="areas">
        <div class="container">
            <h2 class="text-center">发现产品</h2>
            
            <?php
            
                //Display all the categories that are active
                //Sql Query
                $sql = "SELECT *FROM tbl_area WHERE active='是'";

                //Execute the query
                $res = mysqli_query($conn,$sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether categories available or not
                if($count>0)
                {
                    //Areas Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
            
                        <a href="<?php echo SITEURL; ?>area-products.php?area_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>图片未找到</div>"; 
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/area/<?php echo $image_name; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
            
                        <?php
                    }
                }
                else
                {
                    //Areas not available
                    echo "<div class='error'>产地未找到</div>";
                }
            ?>
            


            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Areas Section Ends Here -->

<?php include('partials-front/footer.php'); ?>

