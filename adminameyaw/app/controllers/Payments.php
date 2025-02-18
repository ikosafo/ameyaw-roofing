<?php

class Payments extends Controller
{

    public function process()
    {
        new Guard();
        $this->view("payments/process");
    }

    public function history()
    {
        new Guard();
        $this->view("payments/history");
    }

   
}