<?php

class Orders extends PostController
{

    public function orderItems() {
        $searchTerm = $_POST['searchTerm'];
        $orderItems = Order::orderItems($searchTerm);
        $orderItemsNumber = Order::orderItemsCount($searchTerm);
        $this->view("orders/orderItems", 
            [
                'orderItems' => $orderItems,
                'orderItemsNumber' => $orderItemsNumber
            ]
        ); 
    }



}
 