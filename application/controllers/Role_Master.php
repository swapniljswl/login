<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role_Master extends CI_Controller 
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
		$data['role_items']=$this->get_role_master();
		$data['root_role']=$this->get_root_role();
		$umenu['menu'] = html_escape($this->Loginmodel->menumaster());
		// print_r($umenu['menu']);exit;		
		//$this->load->view('login1/app/view_home.php');
		$this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/app/view_role_master',$data);
		$this->load->view('login1/login/footer');
	
	}

	public function get_role_master()
	{
		$this->load->model('app/Model_role_master');
		$role=html_escape($this->Model_role_master->get_role_with_parent());
		$this->Model_role_master->closeConn();
		return $role;
	}
	public function get_root_role()
	{
		$this->load->model('app/Model_role_master');
		$root_role=html_escape($this->Model_role_master->get_role_detail(1));
		$this->Model_role_master->closeConn();
		return $root_role;
	}
	
	public function add()
	{
		$this->lib_csrf->csrf_verify();
		$role=json_decode($this->input->post('role'),TRUE);
		$parent=$this->input->post('parent');
		//$user=$this->vig_lib->get_vigilance_session();
		$user_data=unserialize($this->session->secret);
		
		if(!empty($role)){
			$this->load->model('app/Model_role_master');
			foreach ($role as $role_item) {
				$role_item['entry_by']=$user_data[0]->ipasid;
				$role_item['entry_on']=date("Y-m-d H:i:s");
				$this->Model_role_master->insert_child($role_item,$parent);
			}
			$this->Model_role_master->closeConn();
			//echo base_url('Role_Master');
		}
			$response['csrf_token']=$this->lib_csrf->get_csrf_hash();
			$response['url']=base_url('Role_Master');
			echo json_encode($response);
	}
	public function update()
	{
		$this->lib_csrf->csrf_verify();
		$role=json_decode($this->input->post('role'),TRUE);
		  $user_data=unserialize($this->session->secret);
		//$user=$this->vig_lib->get_vigilance_session();
		
		if(!empty($role)){
			$this->load->model('app/Model_role_master');
			foreach ($role as $role_item) {
				$role_item['modified_by']=$user_data[0]->ipasid;
				$role_item['modified_on']=date("Y-m-d H:i:s");
				$this->Model_role_master->update_child($role_item);
			}	
			$this->Model_role_master->closeConn();
			//echo base_url('Role_Master');
		}
		$response['csrf_token']=$this->lib_csrf->get_csrf_hash();
		$response['url']=base_url('Role_Master');
		echo json_encode($response);

	}
}