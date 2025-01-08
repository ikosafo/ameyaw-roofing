<?php

class Products extends Controller
{

    public function categories()
    {
        $this->view("products/categories");
    }

    public function add()
    {
        $this->view("products/add");
    }

    public function list()
    {
        $this->view("products/list");
    }

    public function websiteProducts()
    {
        $this->view("products/websiteProducts");
    }
    

   
}