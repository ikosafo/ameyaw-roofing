<?php

class Suppliers extends Controller
{

    public function add()
    {
        $this->view("suppliers/add");
    }

    public function list()
    {
        $this->view("suppliers/list");
    }
    

   
}