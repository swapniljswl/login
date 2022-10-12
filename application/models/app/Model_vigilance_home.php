<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_vigilance_home extends CI_Model {
	private $db1;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();	
	}
	
	public function get_user_data($id)
	{
		$sql='select a.login_id,a.name,a.desig_short,a.desig_desc,dte_short_desc dte_short,a.dte_desc,a.bldg_desc,	a.mobno,a.email,a.rly,a.rly_ph_home,a.rly_ph_off,a.group from 
			comapp.empdetail a where a.login_id= ?';
		$query=$this->db->query($sql,array($id));
		return $query->row();
	}
	public function get_user_role($id)
	{
		$sql="select role_id from comapp.comm_user_role where user_id=? and coalesce(status,'A')<>'D'
		order by role_id";
		$result=$this->db->query($sql,array($id));
		return $result->result_array();
	}
		
	public function closeConn()
	{
		$this->db->close();
	}
}