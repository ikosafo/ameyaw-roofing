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

    


}
 