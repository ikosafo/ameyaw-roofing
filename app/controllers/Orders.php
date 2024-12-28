<?php

class Orders extends Controller
{

    public function create()
    {
        $this->view("orders/create");
    }

    public function list()
    {
        $this->view("orders/list");
    } 
    
    public function checkout()
    {
        $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
        
        if (isset($_GET['uuid']) && isset($_GET['subtotal'])) {
            $encryptedUuid = $_GET['uuid'];
            $encryptedSubtotal = $_GET['subtotal'];
            $uuid = Tools::decrypt($encryptedUuid, $encryptionKey);
            $subtotal = Tools::decrypt($encryptedSubtotal, $encryptionKey); 
        }
        
        $orderDetails = Order::orderDetails($uuid,$subtotal);
        $this->view("orders/checkout",
            ['orderDetails' => $orderDetails]
        );
    } 
   
}