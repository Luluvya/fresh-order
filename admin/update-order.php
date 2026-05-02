<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>订单更新</h1>
        <br><br>
        
        
        <?php
            //Check whether id is set or not
            if(isset($_GET['id']))
            {
                //Get the order details
                $id=$_GET['id'];
                
                //Get all other Details based on this id
                
                //SQL query to get the order details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                //Execute query 
                $res = mysqli_query($conn,$sql);
                //Count Rows
                $count = mysqli_num_rows($res);
                
                if($count==1)
                {
                    //Detail Available 
                    $row=mysqli_fetch_assoc($res);
                    
                    $product = $row['product'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                }
                else
                {
                    //Detail not Available
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //Redirect to manage order page
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>
        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>产品名称</td>
                    <td><b><?php echo $product; ?></b></td>
                </tr>
                
                <tr>
                    <td>价格</td>
                    <td>
                        <b>￥ <?php echo $price; ?></b>
                    </td>
                </tr>
                
                <tr>
                    <td>数量</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>状态</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?>value="已下单">已下单</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?>value="运输中">运输中</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?>value="已签收">已签收</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?>value="已取消">已取消</option>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>顾客姓名：</td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>联系方式：</td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>邮箱：</td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email; ?>">
                    </td>
                </tr>
                
                <tr>
                    <td>地址：</td>
                    <td>
                        <textarea name="customer_address" cols="30" rows="5"><?php echo $customer_address; ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                        
                        <input type="submit" name="submit" value="订单更新" class="btn-secondary">
                    </td>
                </tr>
            </table>
            
        </form>
        
        <?php
            //Check whether Update Button is Clicked or not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get all the values from form
                $id=$_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                
                $total = $price * $qty;
                
                $status = $_POST['status'];
                
                $customer_name = $_POST['customer_name'];
                $customer_contact = $_POST['customer_contact'];
                $customer_email = $_POST['customer_email'];
                $customer_address = $_POST['customer_address'];
                
                //Update the values
                $sql2 = "UPDATE tbl_order SET 
                    qty = $qty,
                    total = $total,
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'
                    where id = '$id'
                ";
                //Execute the query
                $res2 = mysqli_query($conn,$sql2);
                
                //Check whether update or not
                //And redirect to manage order with message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>订单更新成功</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>订单更新失败</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
        ?>
        
    </div>
</div>

<?php include('partials/footer.php'); ?>