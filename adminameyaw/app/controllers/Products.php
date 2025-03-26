<?php

class Products extends Controller
{

    public function categories()
    {
        new Guard();
        $this->view("products/categories");
    }

    public function materialTypes()
    {
        new Guard();
        $this->view("products/materialTypes");
    }


    public function profiles()
    {
        new Guard();
        $this->view("products/profiles");
    }

    public function add()
    {
        new Guard();
        $this->view("products/add");
    }

    public function list()
    {
        new Guard();
        $this->view("products/list");
    }

    public function websiteProducts()
    {
        new Guard();
        $this->view("products/websiteProducts");
    }
    

   
}