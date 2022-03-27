<?php
/** @var $rider \app\models\Rider */
/** @var $riders array */
?>
<link rel="stylesheet" href="/css/datatables.min.css" />
<link rel="stylesheet" href="/css/delivery-order.css" />
<link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"/>
<script src="/js/jquery.min.js"></script>
<!--<script src="/js/shopOrder.js" defer></script>-->


<div class="core">
    <h1 class="heading">System <span>Orders</span></h1>
    <div class="container-core delivery-core ">
        <div class = "tab-content">
            <div id="new" data-tab-content class="active">
                <table id="Delivery" class="">
                    <thead>
                    <tr>
                        <th>Rider ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Contact Number</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody id="Delivery-info-rows">
                    <?php
                    foreach($riders as $rider){
                    echo sprintf("
                    <tr>
                        <td>%d</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                        <td>%s</td>
                    </tr>               
                    ",
                    $rider->RiderID,
                    $rider->Name,
                    $rider->Address,
                    $rider->Email,
                    $rider->ContactNo,
                    $rider->Status? "Assigned": "Available",
                    );
                    }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
<script src="/js/datatables.min.js"></script>
<script>
    $("#Delivery").DataTable();
</script>

