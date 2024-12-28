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


    public function customerDetails() {
       
        $customerName = $_POST['customerName'];
        $customerEmail = $_POST['customerEmail'];
        $customerPhone = $_POST['customerPhone'];
        $customerResidence = $_POST['customerResidence'];
        $uuid = $_POST['uuid'];
        $subtotal = $_POST['subtotal'];
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
            $subtotal
        );
    }

    public function paymentDetails() {
        $paymentMethod = $_POST['paymentMethod'];
        $paymentStatus = $_POST['paymentStatus'];
        $notes = $_POST['notes'];
        $uuid = $_POST['uuid'];
        Order::savePayment($paymentMethod,$paymentStatus,$notes,$uuid);
    }
    


}
 