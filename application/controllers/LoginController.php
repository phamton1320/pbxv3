<?php
class LoginController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('LoginModel');
        $this->load->model('MenuModel');
    }
    public function index()
    {
        $data['title'] = "Login PBX";
        $this->load->view('LoginView',$data);
    }
    public function PostLogin()
    {
        $username = trim($this->input->post('username'));
        $password = trim($this->input->post('password'));
        if(isset($_POST['btn_login'])){
            $check = $this->LoginModel->Validation($username,$password);
            if($check == true){
                $users      = $this->LoginModel->LoginUser($username,$password);
                $menus      = $this->MenuModel->getlistMenu();
                $role       = $this->LoginModel->role($users['role_id']);
                $is_login   = true;
                $data = array(
                    'users'     =>  $users,
                    'menus'     =>  $menus,
                    'role'      =>  $role,
                    'is_login'  =>  $is_login,
                );
                $this->session->set_userdata($data);
                redirect(base_url());
            } 
        }
    }
}
?>