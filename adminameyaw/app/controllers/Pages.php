<?php

class Pages extends Controller
{

    public function index()
    {
        new Guard();
        $salesRevenue = Statistics::salesRevenue();
        $unitsSold = Statistics::unitsSold();
        //$topSelling = Statistics::topSelling();
        $currentGrowthRate = Statistics::currentGrowthRate();

        $productNumber = Statistics::productNumber();
        $categoryNumber = Statistics::categoryNumber();
        $materialNumber = Statistics::materialNumber();

        $totalOrders = Statistics::totalOrders();
        $totalInvoices = Statistics::totalInvoices();
        $totalSales = Statistics::totalSales();

        $totalUsers = Statistics::totalUsers();
        $totalClients = Statistics::totalClients();
        $totalAdministrators = Statistics::totalAdministrators();
        $calculateTotalPrice = Tools::calculateTotalPrice();

        $getLastLogin = User::getLastLogin();
        $this->view("pages/index",
        [
           'salesRevenue' => $salesRevenue,
           'unitsSold' => $unitsSold,
           //'topSelling' => $topSelling,
           'currentGrowthRate' => $currentGrowthRate,
           'productNumber' => $productNumber,
           'categoryNumber' => $categoryNumber,
           'materialNumber' => $materialNumber,
           'totalOrders' => $totalOrders,
           'totalInvoices' => $totalInvoices,
           'totalSales' => $totalSales,
           'calculateTotalPrice' => $calculateTotalPrice,
           'totalUsers' => $totalUsers,
           'totalAdministrators' => $totalAdministrators,
           'getLastLogin' => $getLastLogin,
           'totalClients' => $totalClients
        ]);
    }
    

}
