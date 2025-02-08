<?php

class Dashboard extends Controller
{

    public function index()
    {
        new Guard();
        $salesRevenue = Statistics::salesRevenue();
        $unitsSold = Statistics::unitsSold();
        $topSelling = Statistics::topSelling();
        $currentGrowthRate = Statistics::currentGrowthRate();

        $stockLevel = Statistics::stockLevel();
        $lowStockLevel = Statistics::lowStockLevel();
        $removedStock = Statistics::removedStock();

        $totalOrders = Statistics::totalOrders();
        $this->view("dashboard/index",
        [
           'salesRevenue' => $salesRevenue,
           'unitsSold' => $unitsSold,
           'topSelling' => $topSelling,
           'currentGrowthRate' => $currentGrowthRate,
           'stockLevel' => $stockLevel,
           'lowStockLevel' => $lowStockLevel,
           'removedStock' => $removedStock,
           'totalOrders' => $totalOrders
        ]);
    }
    

}
