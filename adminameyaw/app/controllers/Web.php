<?php

class Web extends Controller
{

    public function contacts()
    {
        new Guard();
        $this->view("web/contacts");
    }

    public function support()
    {
        new Guard();
        $this->view("web/support");
    }

    public function contactForm()
    {
        new Guard();
        $this->view("web/contactForm");
    }
    
}