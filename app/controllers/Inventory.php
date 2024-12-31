<?php

class Inventory extends Controller
{

    public function manage()
    {
        $this->view("inventory/manage");
    }

    public function lowStock()
    {
        $this->view("inventory/lowStock");
    }
   
}