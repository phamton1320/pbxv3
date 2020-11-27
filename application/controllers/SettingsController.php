<?php
class SettingsController extends PBX_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function index()
    {
        // $data['content'] = 'settings/content';
        // $this->load->view('template/layout',$data);
    }
    public function search()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            header('Content-Type: application/json');
            $request    = json_decode(file_get_contents('php://input'),true);
            $pageSize   = $request['pageSize'];
            $skip       = $request['skip'];
            $name_extention = $request['name_extention'];
            $user_call   = $request['user_call'];
            $total          = $this->db->get('testkendo')->num_rows();
            $array =    array(
                'name'=>$name_extention,
                'usercall'=>$user_call,
            );

            //$data_searh     = $this->db->like($array)->get('testkendo',$pageSize,$skip)->result_array();
            if($name_extention == "" && $user_call == "")
            {
                $data_searh = $this->db->get('testkendo',$pageSize,$skip)->result_array();
            }
            $data_searh     = $this->db->like($array)->get('testkendo',$pageSize,$skip)->result_array();
            if(count($data_searh) != 0)
            {
                echo json_encode(array('total' => $total, 'data' => $data_searh));
            }
            else{
                echo json_encode(array('total' => 0, 'data' =>[]));
            }
        }
    }


    public function list_settings()
    {
        $request    = json_decode(file_get_contents('php://input'),true);
        $page       = $request['page'];
        $pageSize   = $request['pageSize'];
        $skip       = $request['skip'];
        $take       = $request['take'];

        $total = $this->db->get('testkendo')->num_rows();
        $data = $this->db->get('testkendo',$pageSize,$skip)->result_array();
        echo json_encode(array('total' => $total, 'data' => $data,'error'=>'err'));
    }

    public function Create()
    {
        $request = json_decode(file_get_contents('php://input'),true);
        //print_r($data);

        $name           = $request[0]['name'];
        $usercall       = $request[0]['usercall'];
        $tuchoi         = $request[0]['tuchoi'];
        $chophep        = $request[0]['chophep'];
        $ghiamcuocgoi   = $request[0]['ghiamcuocgoi'];

        $insert_data = array(
            'name'              =>  $name,
            'usercall'          =>  $usercall,
            'tuchoi'            =>  $tuchoi,
            'chophep'           =>  $chophep,
            'ghiamcuocgoi'      =>  $ghiamcuocgoi,
        );
        print_r($insert_data);
        if($name == ''){
            echo json_encode(array('status'=>'error'));
        }else{
            $this->db->insert('testkendo',$insert_data);
        }
        
    }

    public function Update()
    {
        $request = json_decode(file_get_contents('php://input'),true);
        //print_r($data);
        $id             = $request[0]['id'];
        $name           = $request[0]['name'];
        $usercall       = $request[0]['usercall'];
        $tuchoi         = $request[0]['tuchoi'];
        $chophep        = $request[0]['chophep'];
        $ghiamcuocgoi   = $request[0]['ghiamcuocgoi'];

        $update = array(
            'name'              =>  $name,
            'usercall'          =>  $usercall,
            'tuchoi'            =>  $tuchoi,
            'chophep'           =>  $chophep,
            'ghiamcuocgoi'      =>  $ghiamcuocgoi,
        );
        print_r($update);
        $query = $this->db->where(['id'=>$id])->update('testkendo',$update);
        echo json_encode(['data'=>$query]);
    }

    public function Destroy()
    {
        $request = json_decode(file_get_contents('php://input'),true);
        $id = $request[0]['id'];
        //$this->db->where(['id'=>$id])->delete();
        $this->db->delete('testkendo', array('id' => $id));
    }
}

?>