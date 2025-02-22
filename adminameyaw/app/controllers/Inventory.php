<?php

class Inventory extends Controller
{

    public function manage()
    {
        new Guard();
        $this->view("inventory/manage");
    }

    public function lowStock()
    {
        new Guard();
        $this->view("inventory/lowStock");
    }

    public function restock()
    {
        new Guard();
        $this->view("inventory/restock");
    }
   
}