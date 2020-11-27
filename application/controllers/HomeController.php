<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends PBX_Controller {
   
	public function index()
	{   
        $menu = $this->session->userdata('listmenus');
        // echo "<pre>";
        // print_r($menu);
        // echo "</pre>";
        $data['listmenus'] = $menu;
        $data['content'] = 'settings/content_done';
        $this->load->view('template/layout',$data);
    }   
}

?>