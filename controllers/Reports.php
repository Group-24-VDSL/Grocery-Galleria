<?php

namespace app\controllers;

use app\core\Controller;

class Reports extends Controller
{
    public function itemReport()
    {
        $this->setLayout("dashboardL-staff");
        $query ="SELECT it.ItemID,it.Name,it.UWeight, it.Unit, SUM(odc.Total) AS TotRev, sum(odc.Quantity) AS TotQty FROM item it
                        INNER JOIN ordercart odc ON
                        it.ItemID = odc.ItemID
                        INNER JOIN orders od ON
                        odc.CartID = od.CartID
                        WHERE MONTH(od.OrderDate) = 12
                        GROUP BY ItemID";
        return $this->render("staff/report-view");
    }

    public function salesReport()
    {

    }

    public function deliveryReport()
    {

    }

    public function shopReport()
    {

    }

}