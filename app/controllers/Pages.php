<?php

class Pages extends Controller
{

    public function index()
    {
        $this->view("pages/index");
    }

    public function about()
    {
        $this->view("pages/about");
    }

    public function careers()
    {
        $this->view("pages/careers");
    }

    public function privacy()
    {
        $this->view("pages/privacy");
    }

    public function contact()
    {
        $this->view("pages/contact");
    }

    public function services()
    {
        $this->view("pages/services");
    }

    public function shop()
    {
        $this->view("pages/shop");
    }

}
