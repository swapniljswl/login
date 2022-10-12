<?php
defined('BASEPATH') OR exit('No Direct script access allowed');

class Model_menu_master extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_menu_with_parent()
	{
		$sql="select menu_id,menu_name,title,\"path\",lft,rght,parent_id,sort_order
		from (
				select parent_id,node.menu_id,node.menu_name,node.title,node.\"path\",node.lft,node.rght, (COUNT(parent.menu_id)-1 -sub_tree.par_depth ) AS Depth,
				node.sort_order  
				FROM comapp.comm_menu_master AS node,
            	comapp.comm_menu_master AS parent,
            	comapp.comm_menu_master AS sub_parent,
           		(
            		SELECT node.menu_id parent_id, (COUNT(parent.menu_id) - 1) AS par_depth
            		FROM comapp.comm_menu_master AS node,
            		comapp.comm_menu_master AS parent
            		WHERE node.lft BETWEEN parent.lft AND parent.rght
            		GROUP BY node.menu_id
            	) AS sub_tree
            WHERE node.lft BETWEEN parent.lft AND parent.rght
            	AND node.lft BETWEEN sub_parent.lft AND sub_parent.rght
            	AND sub_parent.menu_id = sub_tree.parent_id
            GROUP BY node.menu_id,sub_tree.par_depth,node.title,node.lft,parent_id,node.menu_name,node.\"path\",node.rght,node.sort_order
            --HAVING depth = 1
            ORDER BY node.sort_order) result
            where depth=1";
        $result=$this->db->query($sql);
        return $result->result_array();
	}
	public function get_menu_detail($menu_id)
	{
		$this->db->select('menu_id,menu_name,path,lft,rght,title,sort_order');
		$result=$this->db->get_where('comapp.comm_menu_master',array('menu_id'=>$menu_id));
		return $result->row_array();
	}

	public function insert_child($menu_item,$parent)
	{
		$this->db->trans_start();
		$parent=$this->get_menu_detail($parent);
		$sql="update comapp.comm_menu_master set rght=rght+2 where rght > ?";
		$this->db->query($sql,array($parent['rght']));
		$sql="update comapp.comm_menu_master set lft=lft+2 where lft > ?";
		$this->db->query($sql,array($parent['rght']));
		$sql="update comapp.comm_menu_master set rght=rght+2 where rght= ?";
		$this->db->query($sql,array($parent['rght']));
		$mid=$this->db->select_max('menu_id')->get('comapp.comm_menu_master')->row()->menu_id+1;
		$menu_item['icon']=($menu_item['icon']==true)?'mdi mdi-view-dashboard':NULL;
		$sql="Insert into comapp.comm_menu_master(menu_id,menu_name,path,lft,rght,title,sort_order,entry_by,entry_on) values(?,?,?,?,?,?,?,?,?)";
		$this->db->query($sql,array($mid,$menu_item['menu_name'],$menu_item['path'],$parent['rght'],$parent['rght']+1,$menu_item['title'],$menu_item['sort_order'],$menu_item['entry_by'],$menu_item['entry_on']));
		$this->db->trans_complete();
	}

	public function update_child($data)
	{
		$this->db->where('menu_id',$data['menu_id']);
		unset($data['menu_id']);//removing menu_id from array so that it never gets updated.
		$this->db->update('comapp.comm_menu_master',$data);

	}
	
	public function closeConn()
	{
		$this->db->close();
	}
}







































