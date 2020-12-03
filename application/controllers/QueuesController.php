<?php
class QueuesController extends PBX_Controller
{
    public function index()
	{   
        $menu = $this->session->userdata('listmenus');
        // echo "<pre>";
        // print_r($menu);
        // echo "</pre>";
        $data['listmenus'] = $menu;
        $data['content'] = 'settings/queues_view2';
        $this->load->view('template/layout',$data);
    }  
    public function search()
    {
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            header('Content-Type: application/json');
            $request    = json_decode(file_get_contents('php://input'),true);
            $pageSize   = $request['pageSize'];
            $skip       = $request['skip'];
            $name       = $request['name'];
            $context    = $request['context'];
            $total      = $this->db->get('queues')->num_rows();
            $array = array(
                'name'      =>$name,
                'context'   =>$context,
            );
            if($name == "" && $context == "")
            {
                $data_searh = $this->db->get('queues',$pageSize,$skip)->result_array();
            }

            $data_searh     = $this->db->like($array)->get('queues',$pageSize,$skip)->result_array();
            if(count($data_searh) != 0)
            {
                echo json_encode(array('total' => $total, 'data' => $data_searh));
            }
            else{
                echo json_encode(array('total' => 0, 'data' =>[]));
            }
        }
    }
    
    public function Create()
    {
        $request = json_decode(file_get_contents('php://input'),true);
        $insert_data = array(
            'name'             =>  $request[0]['name'],
            'context'          =>  $request[0]['context'],
            'description'      =>  $request[0]['description'],
            'autopause'        =>  $request[0]['autopause'],
            'retry'            =>  $request[0]['retry'],
            'ghiamcuocgoi'     =>  $request[0]['ghiamcuocgoi'],
        );
        print_r($insert_data);
        if($insert_data['name'] == ''){
            echo json_encode(array('status'=>'error'));
        }else{
            $this->db->insert('queues',$insert_data);
        }
        
    }

    public function Update()
    {
        $request = json_decode(file_get_contents('php://input'),true);
        $update_data = array(
            'id'               =>  $request[0]['id'],
            'name'             =>  $request[0]['name'],
            'context'          =>  $request[0]['context'],
            'description'      =>  $request[0]['description'],
            'autopause'        =>  $request[0]['autopause'],
            'retry'            =>  $request[0]['retry'],
            'ghiamcuocgoi'     =>  $request[0]['ghiamcuocgoi'],
        );
        print_r($update_data);
        if($update_data['name'] == ''){
            echo json_encode(array('status'=>'error'));
        }else{
            $this->db->where(['id'=>$update_data['id']])->update('queues',$update_data);
        }
    }

    public function agent()
    {
        $id['id'] = $this->uri->segment(3, 0);   //Lay id tren uri
        $this->session->set_userdata($id);
        $menu               = $this->session->userdata('listmenus');
        $data['listmenus']  = $menu;
        $data['content']    = 'settings/agent_view';
        $this->load->view('template/layout',$data);
    }
    public function list_agent()
    {
        $id = $this->session->userdata('id');
        $request    = json_decode(file_get_contents('php://input'),true);
        $pageSize   = $request['pageSize'];
        $skip       = $request['skip'];
        $name       = $request['name'];
        $context    = $request['context'];
        $total_agent= $this->db->get('agent')->num_rows();
        $data_agent = $this->db->where(['queues_id'=>$id])->get('agent',$pageSize,$skip)->result_array();
        echo json_encode(array('total' => $total_agent, 'data' => $data_agent));
    }

    public function create_agent()
    {
        $id = $this->session->userdata('id');
        $request = json_decode(file_get_contents('php://input'),true);
        $insert_data = array(
            'queues_id'       =>  $id,
            'name'            =>  $request[0]['name'],
            'member'          =>  $request[0]['member'],
        );
        print_r($insert_data);
        if($insert_data['name'] == ''){
            echo json_encode(array('status'=>'error'));
        }else{
            $this->db->insert('agent',$insert_data);
        }
    }

    public function agentUp()
    {
        $id = $this->uri->segment(3, 0);
        $queues_id = $this->session->userdata('id');
        $datas = $this->db->where(['queues_id'=>$queues_id])->get('agent')->result_array();
        foreach($datas as $key => $item){
            if($item['id'] == $id)
            {
                $key_up = $key - 1; 
                $id_update = $datas[$key_up]['id'];
                if($key_up>-1){
                    $data_old = array(
                        'member'    => $datas[$key_up]['member'],
                        'name'      => $datas[$key_up]['name'],
                    );
                    $this->db->where(['id'=>$id])->update('agent',$data_old);
                    $data = array(
                        'member'    => $item['member'],
                        'name'      => $item['name'],
                    );
                    // echo $id_update."<br/>";
                    // echo $data_old['member']."-- Ten Cu<br/>";
                    // echo $data['member'];
                    $up_row = $this->db->where(['id'=>$id_update])->update('agent',$data);
                    echo json_encode(array('status'=>$up_row));
                    //redirect(base_url().'QueuesController/agent/'.$queues_id);   
                }
            }
        }
    }

    public function agentDown()
    {
        $id         = $this->uri->segment(3, 0);
        $queues_id  = $this->session->userdata('id');
        $datas      = $this->db->where(['queues_id'=>$queues_id])->get('agent')->result_array();
        $total_data = count($datas);
        // $total_data = $this->db->get('agent')->num_rows();
        foreach($datas as $key => $item){
            if($item['id'] == $id)
            {
                $key_up = $key + 1; 
                $id_update = $datas[$key_up]['id']; 
                if($key_up < $total_data){
                    $data_old = array(
                        'member'    => $datas[$key_up]['member'],
                        'name'      => $datas[$key_up]['name'],
                    );
                    $this->db->where(['id'=>$id])->update('agent',$data_old);
                    $data = array(
                        'member'    => $item['member'],
                        'name'      => $item['name'],
                    );
                    $down_row = $this->db->where(['id'=>$id_update])->update('agent',$data);
                    echo json_encode(array('status'=>$down_row));
                }
                //redirect(base_url().'QueuesController/agent/'.$queues_id);
            }
        }
    }
}
?>