<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_Master extends CI_Controller 
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
		$data['menu_items']=$this->get_menu_master();
		$data['root_menu']=$this->get_root_menu();
		$umenu['menu'] = $this->Loginmodel->menumaster();
		// print_r($umenu['menu']);exit;		
		//$this->load->view('login1/app/view_home.php');
		$this->load->view('login1/login/header',$umenu);
		$this->load->view('login1/app/view_menu_master',$data);
		$this->load->view('login1/login/footer');
	}

	public function get_menu_master()
	{
		$this->load->model('app/Model_menu_master');
		$menu=html_escape($this->Model_menu_master->get_menu_with_parent());
		$this->Model_menu_master->closeConn();
		return $menu;
	}
	public function get_root_menu()
	{
		$this->load->model('app/Model_menu_master');
		$root_menu=html_escape($this->Model_menu_master->get_menu_detail(1));
		$this->Model_menu_master->closeConn();
		return $root_menu;
	}
	
	public function add()
	{
		$this->lib_csrf->csrf_verify();
		$menu=json_decode($this->input->post('menu'),TRUE);
		$parent=$this->input->post('parent');
	    $user_data=unserialize($this->session->secret);
		if(!empty($menu)){			
			$this->load->model('app/Model_menu_master');
			foreach ($menu as $menu_item) {
				$menu_item['entry_by']=$user_data[0]->ipasid;
				$menu_item['entry_on']=date("Y-m-d H:i:s");
				$this->Model_menu_master->insert_child($menu_item,$parent);
			}	
			$this->Model_menu_master->closeConn();

			//echo base_url('Menu_Master');
		}
			$response['csrf_token']=$this->lib_csrf->get_csrf_hash();
			$response['url']=base_url('Menu_Master');
			echo json_encode($response);
		
	}
	public function update()
	{
		$this->lib_csrf->csrf_verify();
		$menu=json_decode($this->input->post('menu'),TRUE);
		$user_data=unserialize($this->session->secret);		
		if(!empty($menu)){
			$this->load->model('app/Model_menu_master');
			foreach ($menu as $menu_item) {
				$menu_item['modified_by']=$user_data[0]->ipasid;
				$menu_item['modified_on']=date("Y-m-d H:i:s");
				$this->Model_menu_master->update_child($menu_item);
			}	
			$this->Model_menu_master->closeConn();
			//echo base_url('Menu_Master');
		}
			$response['csrf_token']=$this->lib_csrf->get_csrf_hash();
			$response['url']=base_url('Menu_Master');
			echo json_encode($response);
	}
}