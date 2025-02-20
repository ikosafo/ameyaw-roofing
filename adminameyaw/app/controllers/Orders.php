<?php

class Orders extends Controller
{

    public function create()
    {
        $this->view("orders/create");
    }

    public function production()
    {
        $this->view("orders/production");
    }

    public function invoice()
    {
        $this->view("orders/invoice");
    }

    public function sales()
    {
        $this->view("orders/sales");
    }
    
    public function list()
    {
        $this->view("orders/list");
    } 

    public function status()
    {
        $this->view("orders/status");
    }

    public function customers()
    {
        $this->view("orders/customers");
    }

    public function customer()
    {
        $this->view("orders/customer");
    }

    public function checkout()
    {
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
        $listInvoice = Order::listInvoice($inspectionid);
        $inspectionDetails = Order::inspectionDetails($inspectionid);
        $this->view("orders/getinvoice",
            [
                'listInvoice' => $listInvoice,
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
        
        $listInvoice = Order::listInvoice($inspectionid);
        $inspectionDetails = Order::inspectionDetails($inspectionid);
        $this->view("orders/getreceipt",
            [
                'listInvoice' => $listInvoice,
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