<?php

class Reports extends Controller
{

    public function sales()
    {
        new Guard();
        $this->view("reports/sales");
    }
    
}