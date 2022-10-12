<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Model_role_master extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_role_with_parent()
	{
		$sql="select role_id,role_name,lft,rght,parent_id,sort_order
		from (
				select parent_id,node.role_id,node.role_name,node.lft,node.rght, (COUNT(parent.role_id)-1 -sub_tree.par_depth ) AS Depth,node.sort_order  
				FROM comapp.comm_role_master AS node,
            	comapp.comm_role_master AS parent,
            	comapp.comm_role_master AS sub_parent,
           		(
            		SELECT node.role_id parent_id, (COUNT(parent.role_id) - 1) AS par_depth
            		FROM comapp.comm_role_master AS node,
            		comapp.comm_role_master AS parent
            		WHERE node.lft BETWEEN parent.lft AND parent.rght
            		GROUP BY node.role_id
            	) AS sub_tree
            WHERE node.lft BETWEEN parent.lft AND parent.rght
            	AND node.lft BETWEEN sub_parent.lft AND sub_parent.rght
            	AND sub_parent.role_id = sub_tree.parent_id
            GROUP BY node.role_id,sub_tree.par_depth,node.lft,parent_id,node.role_name,node.rght,node.sort_order
            --HAVING depth = 1
             ORDER BY node.sort_order) result
            where depth=1";
        $result=$this->db->query($sql);
        return $result->result_array();
	}
	public function get_role_detail($role_id)
	{
		$this->db->select('role_id,role_name,lft,rght,sort_order');
		$result=$this->db->get_where('comapp.comm_role_master',array('role_id'=>$role_id));
		return $result->row_array();
	}

	public function insert_child($role_item,$parent)
	{
		$this->db->trans_start();
		$parent=$this->get_role_detail($parent);
		$sql="update comapp.comm_role_master set rght=rght+2 where rght > ?";
		$this->db->query($sql,array($parent['rght']));
		$sql="update comapp.comm_role_master set lft=lft+2 where lft > ?";
		$this->db->query($sql,array($parent['rght']));
		$sql="update comapp.comm_role_master set rght=rght+2 where rght= ?";
		$this->db->query($sql,array($parent['rght']));
		$rid=$this->db->select_max('role_id')->get('comapp.comm_role_master')->row()->role_id+1;
		$sql="Insert into comapp.comm_role_master(role_id,role_name,lft,rght,sort_order,entry_by,entry_on) values(?,?,?,?,?,?,?)";
		$this->db->query($sql,array($rid,$role_item['role_name'],$parent['rght'],$parent['rght']+1,$role_item['sort_order'],$role_item['entry_by'],$role_item['entry_on']));
		$this->db->trans_complete();
	}
	public function update_child($data)
	{
		$this->db->where('role_id',$data['role_id']);
		unset($data['role_id']);//removing role_id from array so that it never gets updated.
		$this->db->update('comapp.comm_role_master',$data);

	}
	public function get_role_children($role_id)
	{
		$sql="select distinct node.role_id,node.role_name,node.sort_order
		from comapp.comm_role_master node,comapp.comm_role_master parent
		where node.lft between parent.lft and parent.rght
		and parent.role_id in ?
		order by node.sort_order";
		$result=$this->db->query($sql,array($role_id));
		return $result->result_array();
	}
	public function closeConn()
	{
		$this->db->close();
	}
}