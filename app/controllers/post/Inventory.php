<?php

class Inventory extends PostController
{

    public function manageInventory() {
        $listProducts = Product::listProducts();
        $this->view("inventory/manageInventory",[
            'listProducts' => $listProducts
        ]); 
    }


}
 