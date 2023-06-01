<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remainders_Model extends CI_Model{
//edit
	public function update_remainder($rid,$uid,$edate,$item,$icost,$remarks){
		$data=array(
'UserId'=>$uid,
'RemainderDate'=>$edate,
'RemainderItem'=>$item,
'RemainderCost'=>$icost,
'remarks'=>$remarks
);
		$query=$this->db->where('id',$rid)
    ->update('remainders',$data);
    if($query){
$this->session->set_flashdata('success','Remainder updated successfully.');	
redirect('Remainders/manage');
} else {
$this->session->set_flashdata('error','Something went wrong. Please try again.');	
redirect('Remainders/manage');	
}
	}
// For adding Remainders
public function add($uid,$edate,$item,$icost,$remarks){
$data=array(
'UserId'=>$uid,
'RemainderDate'=>$edate,
'RemainderItem'=>$item,
'RemainderCost'=>$icost,
'remarks'=>$remarks
);
$query=$this->db->insert('remainders',$data);
if($query){
$this->session->set_flashdata('success','Remainder added successfully.');	
redirect('Remainders/add');
} else {
$this->session->set_flashdata('error','Something went wrong. Please try again.');	
redirect('Remainders/add');	
}
}
//For Manage Remainders
public function manage($uid)
{
	$query=$this->db->select('RemainderDate,RemainderItem,RemainderCost,NoteDate,remarks,ID')
	     ->where('UserId',$uid)
	     ->get('remainders');
	     return $query->result();
}

// For Remainders Deletion
public function delete($uid){
$query=$this->db->where('ID',$uid)
                ->delete('remainders');
}
//getRemainders
public function get_remainder_details($uid)
{
	$query=$this->db->select('RemainderDate,RemainderItem,RemainderCost,NoteDate,remarks,ID')
	     ->where('ID',$uid)
	     ->get('remainders');
	     return $query->result();
}

}