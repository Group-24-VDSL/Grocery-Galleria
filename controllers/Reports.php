<?php

namespace app\controllers;

use app\core\Controller;
use app\core\db\DBModel;
use app\core\Request;

class Reports extends Controller
{

    public function systemReports()
    {
        $this->setLayout('dashboardL-staff');
        return $this->render("staff/report-view");

    }

//    public function itemReport()
//    {
//        $querySQL = "SELECT it.Name,it.UWeight, it.Unit, SUM(odc.Total) AS TotRev, sum(odc.Quantity) AS TotQty FROM item it
//                    INNER JOIN ordercart odc ON
//                        it.ItemID = odc.ItemID
//                        INNER JOIN orders od ON
//                        odc.CartID = od.CartID
//                        WHERE MONTH(od.OrderDate) = 12
//                        GROUP BY it.ItemID";
//        $itemRevenue = DBModel::query($querySQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
//        return json_encode($itemRevenue);
//    }

    public function salesReportCurrent()
    {
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $querySQL = "SELECT MONTHNAME(OrderDate) AS Month,SUM(TotalCost) AS Total,SUM(DeliveryCost) 
                    AS Delivery FROM `orders` WHERE YEAR(orders.OrderDate)=YEAR(CURDATE()) GROUP BY Month(OrderDate)";
        $salesRevenue = DBModel::query($querySQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
        return json_encode($salesRevenue);

    }
    public function salesReportLast()
    {
        $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $querySQL = "SELECT MONTHNAME(OrderDate) AS Month,SUM(TotalCost) AS Total,SUM(DeliveryCost) 
                    AS Delivery FROM `orders` WHERE YEAR(orders.OrderDate)=(YEAR(CURDATE())-1) GROUP BY Month(OrderDate)";
        $salesRevenue = DBModel::query($querySQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
        return json_encode($salesRevenue);

    }

    public function deliveryReport()
    {

    }

    public function shopReport()
    {

    }

}