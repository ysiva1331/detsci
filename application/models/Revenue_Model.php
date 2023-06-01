<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue_Model extends CI_Model{
//edit
	public function updateRevenue($rid,$uid,$edate,$item,$icost,$remarks){
		$data=array(
'UserId'=>$uid,
'RevenueDate'=>$edate,
'RevenueItem'=>$item,
'RevenueCost'=>$icost,
'remarks'=>$remarks
);
		$query=$this->db->where('id',$rid)
    ->update('revenue',$data);
    if($query){
$this->session->set_flashdata('success','Revenue updated successfully.');	
redirect('Revenue/manage');
} else {
$this->session->set_flashdata('error','Something went wrong. Please try again.');	
redirect('Revenue/manage');	
}
	}
// For adding Revenue
public function add($uid,$edate,$item,$icost,$remarks){
$data=array(
'UserId'=>$uid,
'RevenueDate'=>$edate,
'RevenueItem'=>$item,
'RevenueCost'=>$icost,
'remarks'=>$remarks
);
$query=$this->db->insert('revenue',$data);
if($query){
$this->session->set_flashdata('success','Revenue added successfully.');	
redirect('Revenue/add');
} else {
$this->session->set_flashdata('error','Something went wrong. Please try again.');	
redirect('Revenue/add');	
}
}
//For Manage Revenue
public function manage($uid)
{
	$query=$this->db->select('RevenueDate,RevenueItem,RevenueCost,NoteDate,remarks,ID')
	     ->where('UserId',$uid)
	     ->get('revenue');
	     return $query->result();
}

// For Revenue Deletion
public function delete($uid){
$query=$this->db->where('ID',$uid)
                ->delete('revenue');
}
//getRevenue
public function getRevenuedetails($uid)
{
	$query=$this->db->select('RevenueDate,RevenueItem,RevenueCost,NoteDate,remarks,ID')
	     ->where('ID',$uid)
	     ->get('revenue');
	     return $query->result();
}

}