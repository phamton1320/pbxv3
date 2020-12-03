<?php

class RouterKendoController extends PBX_Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        $this->load->view("routerkendo");
    }
}

?>