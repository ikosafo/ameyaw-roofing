<?php

class Orders extends PostController
{

    public function orderItems() {
        $searchTerm = $_POST['searchTerm'];
        $uuid = $_POST['uuid'];
        $orderItems = Order::orderItems($searchTerm);
        $orderItemsNumber = Order::orderItemsCount($searchTerm);
        $this->view("orders/orderItems", 
            [
                'orderItems' => $orderItems,
                'orderItemsNumber' => $orderItemsNumber,
                'uuid' => $uuid
            ]
        ); 
    }


    public function cart() {
        $cartid = !empty($_POST['cartid']) ? $_POST['cartid'] : null;
        $uuid = !empty($_POST['uuid']) ? $_POST['uuid'] : null;
        Order::insertCart($cartid,$uuid);
        $cartItems = Order::cartItems($uuid);
        $this->view("orders/cart", 
            [
                'cartid' => $cartid,
                'cartItems' => $cartItems,
                'uuid' => $uuid
            ]
        ); 
    }


    public function updateQuantity() {
        $productId = $_POST['productId'];
        $quantity = $_POST['quantity'];
        $cartid = $_POST['cartId'];
        Order::updateQuantity($productId,$quantity,$cartid);
    }


    public function deleteCartItem() {
        $cartid = $_POST['cartid'];
        Order::deleteCartItem($cartid);
    }


    public function addInspectionForm() {
        $this->view("orders/addInspectionForm"); 
    }


    public function customerDetails() {
       
        $customerName = $_POST['customerName'];
        $customerEmail = $_POST['customerEmail'];
        $customerPhone = $_POST['customerPhone'];
        $customerResidence = $_POST['customerResidence'];
        $uuid = $_POST['uuid'];
        $subtotal = $_POST['subtotal'];
        $deliveryCost = $_POST['deliveryCost'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        $city = $_POST['city'];
        $region = $_POST['region'];
        $deliveryMode = $_POST['deliveryMode'];
        Order::saveCustomer(
            $customerName,
            $customerEmail,
            $customerPhone,
            $customerResidence,
            $uuid,
            $deliveryMode,
            $address1,
            $address2,
            $city,
            $region,
            $subtotal,
            $deliveryCost
        );
    }


    public function paymentDetails() {
        $paymentMethod = $_POST['paymentMethod'];
        $paymentStatus = $_POST['paymentStatus'];
        $notes = $_POST['notes'];
        $uuid = $_POST['uuid'];
        Order::savePayment($paymentMethod,$paymentStatus,$notes,$uuid);
    }


    public function listOrders() {
        $listOrders = Order::listOrders();
        $this->view("orders/listOrders",[
            'listOrders' => $listOrders
        ]); 
    }


    public function viewCustomerOrder() {
        $dbid = $_POST['dbid'];
        $listCustomerOrders = Order::listCustomerOrders($dbid);
        $this->view("orders/viewCustomerOrder",[
            'listCustomerOrders' => $listCustomerOrders,
            'dbid' => $dbid
        ]); 
    }

    
    public function listCustomers() {
        $listCustomers = Order::listCustomers();
        $this->view("orders/listCustomers",[
            'listCustomers' => $listCustomers
        ]); 
    }


    public function statusOrders() {
        $orderStatus = $_POST['orderStatus'];
        $orderFrom = $_POST['orderFrom'];
        $orderTo = $_POST['orderTo'];
        $listOrderStatus = Order::listOrderStatus($orderStatus);
        $this->view("orders/statusOrders",[
            'listOrderStatus' => $listOrderStatus,
            'orderStatus' => $orderStatus,
            'orderFrom' => $orderFrom,
            'orderTo' => $orderTo
        ]); 
    }


    public function viewOrder() {
        $dbid = $_POST['dbid'];
        $orderDetails = Order::orderDetails($dbid);
        $uuid = $orderDetails['uuid'];
        $cartItems = Order::cartItems($uuid);
        $this->view("orders/viewOrder", 
            [
                'orderDetails' => $orderDetails,
                'cartItems' => $cartItems
            ]
        ); 
    }
    

    public function saveInspection() {
        $clientName = $_POST['clientName'];
        $clientTelephone = $_POST['clientTelephone'];
        $clientEmail = $_POST['clientEmail'];
        $siteLocation = $_POST['siteLocation'];
        $inspectionDate = $_POST['inspectionDate'];
        $inspectorName = $_POST['inspectorName'];
        $siteReport = $_POST['siteReport'];
        $uuid = $_POST['uuid'];
        Order::saveInspection($clientName,$clientTelephone,$clientEmail,$siteLocation,$inspectionDate,$inspectorName,$siteReport,$uuid);
    }
    

}
 