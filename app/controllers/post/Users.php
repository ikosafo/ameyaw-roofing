<?php

class Users extends PostController
{

    public function usermanagement()
    {
        new Guard(); 
        $this->view("users/usermanagement");
    }

}
 