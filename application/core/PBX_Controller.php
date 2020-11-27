<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class PBX_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->helper(array('form', 'url','common'));
        
        // $data['content'] = 'home';
        // $this->load->view('template/layout',  $data);
        $role   = json_decode(json_encode($this->session->userdata('role')),true); // Object => array
        //$role   = $this->session->userdata('role');
        $users  = $this->session->userdata('users');
        $menus  = $this->session->userdata('menus');
        if($role){
            foreach($role as $key => $item)
            {
                //Format data menu_id|action
                $str        =   $item;
                $vitri      =   strpos($str,'|');
                $menu_id[]  =   substr($str,0,$vitri);
            }
            
            foreach($menu_id as $key => $item)
            {
                if($item != 0)
                {
                    $key = array_search($item, array_column($menus, 'id'));
                    //$menu[] = $menus[$key];
                    // moi them 25/11
                    $menu[] = $menus[$key];
                    //print_r($menu);
                    $this->session->set_userdata(array('listmenus'=>$menu));
                    //print_r($this->session->userdata('menu'));
                }
            }
        }
        
        // if($this->session->userdata('users')){
        //     //Kiểm tra quyền Login. Update lại $data['listmenus']
        //     $data['listmenus'] =$menu;// $this->session->userdata('menus');
        //     //$data['content'] = 'settings/content_done'; //content
        //     $request = json_decode(file_get_contents('php://input'),true);
        //     if($request)
        //     {
        //         $page = $request['page'];
        //         $pageSize = $request['pageSize'];
        //         $skip = $request['skip'];
        //         $take = $request['take'];
        //         $this->load->view('template/layout',$data,$pageSize);
        //     }
        //     else{
        //         $this->load->view('template/layout',$data);
        //     }
            
        // }else{
        //     redirect(base_url('LoginController'));
        // }

        //moi them 25/11
        if(!$this->session->userdata('users')){
            redirect(base_url('LoginController'));
        }
    }
    
}
?>