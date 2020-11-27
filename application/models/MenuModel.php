<?php
class MenuModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getlistMenu()
    {
        $query  = $this->db->get('menu');
        $data     = $query->result_array();
        return $data;
    }
}

?>