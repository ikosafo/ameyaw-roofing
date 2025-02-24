<?php

class Orders extends Controller
{

    public function create()
    {
        new Guard();
        $this->view("orders/create");
    }

    public function invoicing()
    {
        new Guard();
        $this->view("orders/invoicing");
    }

    public function invoice()
    {
        new Guard();
        $this->view("orders/invoice");
    }

    public function sales()
    {
        new Guard();
        $this->view("orders/sales");
    }
    
    public function list()
    {
        new Guard();
        $this->view("orders/list");
    } 

    public function status()
    {
        new Guard();
        $this->view("orders/status");
    }

    public function customers()
    {
        new Guard();
        $this->view("orders/customers");
    }

    public function customer()
    {
        new Guard();
        $this->view("orders/customer");
    }

    public function checkout()
    {
        new Guard();
        $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
        
        if (isset($_GET['uuid'])) {
            $encryptedUuid = $_GET['uuid'];
            $uuid = Tools::decrypt($encryptedUuid, $encryptionKey);
        }
        
        $cartItems = Order::cartItems($uuid);
        $orderDetails = Order::orderDetails($uuid);
        $this->view("orders/checkout",
            [
                'orderDetails' => $orderDetails,
                'cartItems' => $cartItems
            ]
        );
    } 

    
    public function getinvoice()
    {
        $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
        
        if (isset($_GET['uuid'])) {
            $encryptedUuid = $_GET['uuid'];
            $inspectionid = Tools::decrypt($encryptedUuid, $encryptionKey);
        }
        $listProduction = Order::listProduction($inspectionid);
        $inspectionDetails = Order::inspectionDetails($inspectionid);
        $this->view("orders/getinvoice",
            [
                'listProduction' => $listProduction,
                'inspectionDetails' => $inspectionDetails
            ]
        );
    } 



    public function getproduction()
    {
        $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
        
        if (isset($_GET['uuid'])) {
            $encryptedUuid = $_GET['uuid'];
            $inspectionid = Tools::decrypt($encryptedUuid, $encryptionKey);
        }
        $listProduction = Order::listProduction($inspectionid);
        $inspectionDetails = Order::inspectionDetails($inspectionid);
        $this->view("orders/getproductionForm",
            [
                'listProduction' => $listProduction,
                'inspectionDetails' => $inspectionDetails
            ]
        );
    } 


    public function getReceipt()
    {
        if (isset($_GET['uuid'])) {
            $uuid = $_GET['uuid'];
            list($hash, $dbid) = explode(":", $uuid, 2);
            $inspectionid = htmlspecialchars($dbid);
        }  
        $listProduction = Order::listProduction($inspectionid);
        $inspectionDetails = Order::inspectionDetails($inspectionid);
        $this->view("orders/getreceipt",
            [
                'listProduction' => $listProduction,
                'inspectionDetails' => $inspectionDetails
            ]
        );
    } 

    

    public function receipt()
    {
        $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
        
        if (isset($_GET['uuid'])) {
            $encryptedUuid = $_GET['uuid'];
            $uuid = Tools::decrypt($encryptedUuid, $encryptionKey);
        }
        $cartItems = Order::cartItems($uuid);
        $orderDetails = Order::orderDetails($uuid);
        $this->view("orders/receipt",
            [
                'orderDetails' => $orderDetails,
                'cartItems' => $cartItems
            ]
        );
    } 
   
}