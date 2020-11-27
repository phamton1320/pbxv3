<?php
class LoginModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('session');
    }
    public function LoginUser($username,$password)
    {
        $sql = $this->db->get_where("users",['username'=>$username,'pass'=>$password]);
        $rowdb = $sql->row();
        if(isset($rowdb)){
            //print_r($rowdb);
            //var_dump($rowdb);
            //Khi la object se dung $rowdb->username
            $newdata = array(
                'username'  => $rowdb->username,
                'fullname'  => $rowdb->fullname,
                'role_id'   => $rowdb->role_id,
                'phone'     => $rowdb->phone,
                'mail'      => $rowdb->mail,
                'status'    => $rowdb->status,
            );
            return $newdata;
            //$this->session->set_userdata($newdata);
        }else{
            //echo 'kiem tra user or pass';
            $this->session->set_flashdata('login_error', 'Please check your <strong>USERNAME</strong> or <strong>PASSWORD</strong> and try again.', 300);
			redirect(base_url());
        }
    }
    public function Validation($username,$password)
    {
        $username = $this->form_validation->set_rules('username', 'Username', 'required');
        $password = $this->form_validation->set_rules('password', 'Password', 'required',
                array('required' => 'You must provide a %s.')
        );
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('LoginView');
        }
        else{return true;}
    }

    public function role($role_id)
    {
        $query  = $this->db->get_where('role',['id'=>$role_id]);
        $db     = $query->row();
        return $db;
    }
}
?>