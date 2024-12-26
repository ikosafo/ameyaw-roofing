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
   
}