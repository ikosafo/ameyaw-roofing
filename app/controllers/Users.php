<?php

class Users extends Controller
{

    public function index()
    {
        new Guard();
        $uid = $_SESSION['uid'];
        $salesRevenue = Statistics::salesRevenue();
        $unitsSold = Statistics::unitsSold();
        $topSelling = Statistics::topSelling();
        $currentGrowthRate = Statistics::currentGrowthRate();

        $stockLevel = Statistics::stockLevel();
        $lowStockLevel = Statistics::lowStockLevel();
        $removedStock = Statistics::removedStock();

        $totalOrders = Statistics::totalOrders();
        $userId = Tools::getMISUserid($_SESSION['uid']);
        $userPermissions = Tools::getUserPermissions($userId);
        $this->view("users/index",
        [
           'salesRevenue' => $salesRevenue,
           'unitsSold' => $unitsSold,
           'topSelling' => $topSelling,
           'currentGrowthRate' => $currentGrowthRate,
           'stockLevel' => $stockLevel,
           'lowStockLevel' => $lowStockLevel,
           'removedStock' => $removedStock,
           'totalOrders' => $totalOrders,
           'userPermissions' => $userPermissions
        ]);
    }

}
