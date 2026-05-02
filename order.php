
<?php include('partials-front/menu.php'); ?>

<?php
    //Check whether product id is set or not
if(isset($_GET['product_id']))
{
    //Get the product id and details of the selected food
    $product_id = $_GET['product_id'];
    
    //Get the Details of the Selected Food
    $sql = "SELECT * FROM tbl_product WHERE id=$product_id";
    //Execute the Query
    $res = mysqli_query($conn,$sql);
    //Count the rows
    $count = mysqli_num_rows($res);
    //Check whether the data is available or not
    if($count==1)
    {
        //We have data
        //Get the data from database
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    }
    else
    {
        //Product not Available
        //Redirect to Home Page
        header('location:'.SITEURL);
    }
}
else
{
    //Redirect to homepage
    header('location:'.SITEURL);
}
?>

<!-- Product Search Section Starts Here -->
<section class="product-search">
    <div class="container">
        
        <h2 class="text-center text-white">填表确定订单</h2>

        <form action="" method="POST" class="order">
            <fieldset>
                <legend>已选产品</legend>

                <div class="product-menu-img">
                    <?php
                        //Check whether the image is available or not
                    if($image_name=="")
                    {
                        //Image Available
                        echo "<div class='error'>图片不可用</div>";
                    }
                    else
                    {
                        //Image is Available
                        ?>
                        <img src="<?php echo SITEURL; ?>images/product/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        <?php
                    }
                    ?>
                   
                </div>

                <div class="product-menu-desc">
                    <h3><?php echo $title; ?></h3>
                    <input type="hidden" name="product" value="<?php echo $title; ?>">
                    
                    <p class="product-price">￥<?php echo $price; ?></p>
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <div class="order-label">数量</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>
                    
                </div>

            </fieldset>
            
            <fieldset>
                <legend>订单详情</legend>
                <div class="order-label">姓名</div>
                <input type="text" name="full-name" placeholder="例：张一一" class="input-responsive" required>

                <div class="order-label">联系方式</div>
                <input type="tel" name="contact" placeholder="例：182xxxx0128" class="input-responsive" required>

                <div class="order-label">邮箱</div>
                <input type="email" name="email" placeholder="例：DanlanZ11@163.com" class="input-responsive" required>

                <div class="order-label">地址</div>
                <textarea name="address" rows="10" placeholder="例：xx省xx市xx街道" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="确认订单" class="btn btn-primary">
            </fieldset>

        </form>
        <?php
            //Check whether submit button is clicked or not
            if(isset($_POST['submit']))
            {
                //Get all the details from the form 
                
                $product = $_POST['product'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                
                $total = $price * $qty;//total = price * qty
                
                $order_date = date("Y-m-d h:i:sa");//Order Date
                
                $status = "Ordered";//Ordered,On Delivery,Delivered,Cancelled
                
                $customer_name = $_POST['full-name'];
                $customer_contact = $_POST['contact'];
                $customer_email = $_POST['email'];
                $customer_address = $_POST['address'];
                
                //Save the Order in Database
                //Create SQL to Save the Data
                $sql2 = "INSERT INTO tbl_order SET 
                    product = '$product',
                    price = $price,
                    qty = $qty,
                    total = $total,
                    order_date = '$order_date',
                    status = 'status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                ";
                
                //Execute the Query
                $res2 = mysqli_query($conn,$sql2);
                
                //Check whether query executed successfully or not
                if($res2==true)
                {
                    //Query Executed and Order Saved
                    $_SESSION['order'] = "<div class='success text-center'>下单成功</div>";
                    header('location:'.SITEURL);                       
                }
                else 
                {
                    //Failed to Save Order
                    $_SESSION['order'] = "<div class='error text-center'>下单失败</div>";
                    header('location:'.SITEURL);  
                }
                
            }
        ?>
    </div>
</section>
<!-- Product Search Section Ends Here -->

<?php include('partials-front/footer.php'); ?>