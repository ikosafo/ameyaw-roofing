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
        $cartid = $_POST['cartid'];
        $uuid = $_POST['uuid'];
        Order::insertCart($cartid,$uuid);
        $cartItems = Order::cartItems($uuid);
        $this->view("orders/cart", 
            [
                'cartid' => $cartid,
                'cartItems' => $cartItems
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

    


}
 