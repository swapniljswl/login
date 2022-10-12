<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Model_assign_role extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function save($data)
	{
		$this->db->trans_start();
		foreach ($data as $data_item) {
			if($data_item['val']==0)
			{
				$this->db->where('role_id',$data_item['role_id']);
				$this->db->where('user_id',$data_item['user_id']);
				unset($data_item['role_id']);
				unset($data_item['user_id']);
				unset($data_item['val']);
				$this->db->update('comapp.comm_user_role',$data_item);
			}
			else if ($data_item['val']==1)
			{
				unset($data_item['val']);
				$this->db->set($data_item);
				$this->db->insert('comapp.comm_user_role');
			}
		}
		$this->db->trans_complete();
	}
	public function closeConn()
	{
		$this->db->close();
	}
}