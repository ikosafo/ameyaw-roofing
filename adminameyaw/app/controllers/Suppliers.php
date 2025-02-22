<?php

class Suppliers extends Controller
{

    public function add()
    {
        new Guard();
        $this->view("suppliers/add");
    }

    public function list()
    {
        new Guard();
        $this->view("suppliers/list");
    }
    

   
}