<?php
class TestKendoController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index()
    {
        $data_searh['data'] = $this->db->get('testkendo')->result_array();
        $this->load->view('settings/testkendo',$data_searh);
    }

}

?>