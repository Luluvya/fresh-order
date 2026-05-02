<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
       <h1>订单管理</h1>

             <br /><br /><br />
            
             
             <?php
                if(isset($_SESSION['update']))
                {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
             ?>
             <br><br>
             <table class="tbl-full">
                 <tr>
                     <th>序号</th>
                     <th>产品</th>
                     <th>价格</th>
                     <th>数量</th>
                     <th>总价</th>
                     <th>下单日期</th>
                     <th>状态</th>
                     <th>顾客姓名</th>
                     <th>联系方式</th>
                     <th>邮箱</th>
                     <th>地址</th>
                     <th>操作</th>
                 </tr>
                 
                 <?php
                    //Get all the orders from database
                    $sql = "SELECT * FROM tbl_order ORDER BY id DESC";//Diaplay the latest order at first
                    //Execute Query
                    $res = mysqli_query($conn,$sql);
                    //Count the rows
                    $count = mysqli_num_rows($res);
                    
                    $sn = 1;//Create a Serial Number and set its initial value as 1
                    if($count>0)
                    {
                        //Order Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //Get all the order details
                            $id = $row['id'];
                            $product = $row['product'];
                            $price = $row['price'];
                            $qty = $row['qty'];
                            $total = $row['total'];
                            $order_date = $row['order_date'];
                            $status = $row['status'];
                            $customer_name = $row['customer_name'];
                            $customer_contact = $row['customer_contact'];
                            $customer_email = $row['customer_email'];
                            $customer_address = $row['customer_address'];
                            
                            ?>
                 
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $product; ?></td>
                                    <td><?php echo $price; ?></td>
                                    <td><?php echo $qty; ?></td>
                                    <td><?php echo $total; ?></td>
                                    <td><?php echo $order_date; ?></td>
                                    <td>
                                        <?php
                                            //Ordered on delivery

                                            if($status=="已下单")
                                            {
                                                echo "<label>$status</label>";
                                            }
                                            elseif($status=="运输中")
                                            {
                                                echo "<label style='color: orange;'>$status</label>";
                                            } 
                                            elseif($status=="已签收")
                                            {
                                                echo "<label style='color: green;'>$status</label>";
                                            } 
                                            elseif($status=="已取消")
                                            {
                                                echo "<label style='color: red;'>$status</label>";
                                            } 
                                        ?>
                                    </td>
                                    <td><?php echo $customer_name; ?></td>
                                    <td><?php echo $customer_contact; ?></td>
                                    <td><?php echo $customer_email; ?></td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-secondary">订单更新</a>
                                    </td>
                                </tr>   
                                
                            <?php
                        }
                    }
                    else
                    {
                        //Order not Available
                        echo "<tr><td colspan='12' class='error'>订单未添加</td></tr>";
                    }
                 ?>
                
                 
                  
             </table>
</div>
<?php include('partials/footer.php');?>


