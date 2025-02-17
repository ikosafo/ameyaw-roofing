
<?php

class Reports extends PostController
{
    public function sales() {
        $salesFrom = $_POST['salesFrom'];
        $salesTo = $_POST['salesTo'];
        $listOrderStatus = Report::listSales($salesFrom,$salesTo);
        $this->view("reports/searchSales",[
            'listOrderStatus' => $listOrderStatus,
            'salesFrom' => $salesFrom,
            'salesTo' => $salesTo
        ]); 
    }
    
}

   