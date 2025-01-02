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

    public function status()
    {
        $this->view("orders/status");
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