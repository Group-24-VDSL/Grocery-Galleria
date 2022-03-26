<?php
/** @var array $orders */
?>
<div class="main-content">
    <div class="rider-header-container"><h2 class="header">Orders</h2></div>
    <div class="order-view">
        <h3>New Orders</h3>
        <table id="orders">
            <thead>
                <tr>
                    <th>OrderID</th>
                    <th>Destination</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($orders as $order){
                    echo sprintf("<tr>
                    <td>%d</td>
                    <td>%s</td>
                    <td>Rs.%.2f</td>
                    <td><button type='button' class='btn btn-primary btn-icon-only order-view-button' data-href='/rider/vieworder?id=%d'><i class='far fa-eye'></i></button></td>
                </tr></a>",
                    $order["OrderID"],
                    $order["Address"],
                    $order["TotalCost"],
                    $order["OrderID"]
                    );
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#orders').DataTable();
</script>