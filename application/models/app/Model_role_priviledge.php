<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Model_role_priviledge extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_role_menu($data)
	{
		$sql="select menu_id
		from comapp.comm_role_priv
		where role_id in ?
		and coalesce(status,'A')<>'D'";
		$result=$this->db->query($sql,array($data));
		return $result->result_array();
	}
	public function save_permission($data)
	{
		$this->db->trans_start();
		foreach ($data as $data_item) {
			if($data_item['val']==0)
			{
				$this->db->where('role_id',$data_item['role_id']);
				$this->db->where('menu_id',$data_item['menu_id']);
				$this->db->set('status','D');
				$this->db->set('modified_by',$data_item['entry_by']);
				$this->db->set('modified_on',$data_item['entry_on']);
				$this->db->update('comapp.comm_role_priv');
			}
			else if ($data_item['val']==1)
			{
				unset($data_item['val']);
				$this->db->set($data_item);
				$this->db->insert('comapp.comm_role_priv');
			}
		}
		$this->db->trans_complete();
	}

	public function closeConn()
	{
		$this->db->close();
	}
}