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

    public function shopReports()
    {
        $this->setLayout('dashboardL-staff');
        return $this->render("staff/shop-report");

    }


    public function productReports()
    {
        $this->setLayout('dashboardL-staff');
        return $this->render("staff/product-report");
    }

    public function itemReport(Request $request)
    {
        $body = $request->getBody();
        $itemID = $body['ItemID'];
        $querySQL = "SELECT MONTHNAME(od.OrderDate) AS Month,SUM(odc.Quantity) AS Qty, SUM(odc.Total) AS TotSales FROM ordercart odc 
                        INNER JOIN orders od ON
                        odc.CartID = od.CartID
                        WHERE odc.ItemID = $itemID
                        GROUP BY MONTH(od.OrderDate)";
        $itemRevenue = DBModel::query($querySQL, fetch_type: \PDO::FETCH_ASSOC, fetchAll: true);
        return json_encode($itemRevenue);

    }

    public function getItemWeekReport(Request $request)
    {
        $body = $request->getBody();
        $ID = $body['ItemID'];
        $Date = $body['SalesDate'];
        $querySQL = "SELECT DAYNAME(od.OrderDate) AS Day,SUM(odc.Quantity) AS Qty, SUM(odc.Total) AS Tot FROM ordercart odc 
                    INNER JOIN orders od ON
                    odc.CartID = od.CartID
                    WHERE odc.ItemID = $ID AND WEEK(od.OrderDate) = WEEK('$Date')
                    GROUP BY DAYNAME(od.OrderDate)";
        $results = DBModel::query($querySQL,fetch_type:\PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($results);

    }
    public function getTotalOrders()
    {
        $querySQL = "SELECT COUNT(DISTINCT OrderID) AS TotOrders,SUM(TotalCost) AS TotalRevenue,SUM(DeliveryCost) AS TotalDelReveneu FROM `orders`";
        $result = DBModel::query($querySQL,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($result);
        
    }

    public function getTotalUsers()
    {
        $querySQL = "SELECT Role, COUNT(DISTINCT UserID) as roleCount FROM `login` WHERE Role='Shop' OR Role='Delivery' GROUP BY Role ORDER BY Role ASC";
        $result =DBModel::query($querySQL,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($result);
        
    }

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

    public function shopsReportMonthly(Request $request)
    {
        $body =$request->getBody();
        $cate = $body['Category'];
        $querySQL = "SELECT s.ShopName,s.Address,s.ContactNo,s.Email,SUM(sod.ShopTotal) AS shopTot FROM shop s
                        INNER JOIN shoporder sod ON
                        s.ShopID = sod.ShopID
                        WHERE s.Category=$cate AND 
                        MONTH(sod.Date) = MONTH(CURRENT_DATE)
                        GROUP BY s.ShopID 
                        ORDER BY SUM(sod.ShopTotal) DESC
                        LIMIT 10";
        $topTenShopsOfMonth = DBModel::query($querySQL,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($topTenShopsOfMonth);

    }

    public function shopsReportYearly(Request $request)
    {
        $body = $request->getBody();
        $cate = $body['Category'];
        $querySQL = "SELECT s.ShopName,s.Address,s.ContactNo,s.Email, SUM(sod.ShopTotal) AS shopTot FROM shop s
                        INNER JOIN shoporder sod ON
                        s.ShopID = sod.ShopID
                        WHERE s.Category=$cate AND 
                        YEAR(sod.Date) = YEAR(CURRENT_DATE)
                        GROUP BY s.ShopID 
                        ORDER BY SUM(sod.ShopTotal) DESC
                        LIMIT 10";
        $topShopsAllTime = DBModel::query($querySQL,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($topShopsAllTime);

    }

    public function dailyRevenue(Request $request)
    {
        $body = $request->getBody();
        $Date = $body['SalesDate'];
        $querySQL = "SELECT HOUR(TIME(OrderDate)) AS timeInterval,SUM(TotalCost) AS totRevenue FROM `orders` WHERE DATE(OrderDate)='$Date'
                    GROUP BY HOUR(TIME(OrderDate))";
        $result = DBModel::query($querySQL,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($result);

    }

    public function dailyTotOrders(Request $request)
    {
        $body = $request->getBody();
        $Date = $body['SalesDate'];
        $querySQl = "SELECT HOUR(TIME(OrderDate)) AS timeInterval,COUNT(DISTINCT OrderID) AS totOrders FROM `orders` WHERE DATE(OrderDate)='$Date'
GROUP BY HOUR(TIME(OrderDate))";
        $result =DBModel::query($querySQl,fetch_type: \PDO::FETCH_ASSOC,fetchAll: true);
        return json_encode($result);
    }

}