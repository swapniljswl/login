<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_Priviledge extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		if ((!$this->session->has_userdata('user')) and (!$this->session->has_userdata('secret')))
		{
            $this->load->driver('cache'); # add
            $this->session->sess_destroy(); # Change
            $this->cache->clean();  # add
             redirect(base_url('user_login')); # Your default controller name 		   
            ob_clean();
		}
		$this->lib_csrf->csrf_set_session();
	}
	public function index()
	{
		$this->load->model('login/Loginmodel');
		$umenu['menu'] = html_escape($this->Loginmodel->menumaster());
		$this->load->model('app/Model_role_master');
		$this->load->model('app/Model_menu_master');
		$data['roles']=html_escape($this->Model_role_master->get_role_with_parent());
		$data['root_menu']=html_escape($this->Model_menu_master->get_menu_detail(1));
		$data['menu_items']=html_escape($this->Model_menu_master->get_menu_with_parent());
		$this->Model_role_master->closeConn();
		$this->Model_menu_master->closeConn();
	
		//$this->load->view('login1/app/view_home.php');
		$this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/app/view_role_priviledge',$data);
		$this->load->view('login1/login/footer');
				
	}
	public function get_role_menu()
	{
		try{
			$role_id=$this->input->post('role_id');
			if(!empty($role_id)){
				$response['error']=false;
				$this->load->model('app/Model_role_master');
				$this->load->model('app/Model_menu_master');
				$this->load->model('app/Model_role_priviledge');
				$sub_roles=$this->Model_role_master->get_role_children(array($role_id));
				$sub_role_arr=array();
				foreach($sub_roles as $item)
					array_push($sub_role_arr,$item['role_id']);
				$role_menu=$this->Model_role_priviledge->get_role_menu($sub_role_arr);
				$response['role_menu']=$role_menu;
				$this->Model_role_master->closeConn();
				$this->Model_menu_master->closeConn();
			}
			
		}
		catch(Exception $e){
			$response['error']=true;
			$response['error_msg']=$e->getMessage();
		}
		echo json_encode($response);
	}
	public function save()
	{
		try{
			$this->lib_csrf->csrf_verify();
			$data=json_decode($this->input->post('role_priv'),TRUE);
			if(empty($data))
				throw new Exception('No Data to save.');
			//$user_data=$this->vig_lib->get_vigilance_session();
			$user_data=unserialize($this->session->secret);
			$response['error']=false;
			$this->load->model('app/Model_role_priviledge');
			foreach ($data as &$data_item) {
				$data_item['entry_by']=$user_data[0]->ipasid;
				$data_item['entry_on']=date("Y-m-d H:i:s");
			}
			$this->Model_role_priviledge->save_permission($data);
			$this->Model_role_priviledge->closeConn();
			$response['msg']='Data Saved';
			$response['url']=base_url('Role_Priviledge');
		
		}
		catch(Exception $e){
			$response['error']=true;
			$response['error_msg']=$e->getMessage();
		}
		echo json_encode($response);
	}
}