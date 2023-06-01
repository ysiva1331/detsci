<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_Model extends CI_Model{
//edit
	public function updateexpense($eid,$uid,$edate,$item,$icost){
		$data=array(
'UserId'=>$uid,
'ExpenseDate'=>$edate,
'ExpenseItem'=>$item,
'ExpenseCost'=>$icost
);
		$query=$this->db->where('id',$eid)
    ->update('tblexpense',$data);
    if($query){
$this->session->set_flashdata('success','Expense updated successfully.');	
redirect('http://localhost/detsci/index.php/Expenses/manage');
} else {
$this->session->set_flashdata('error','Something went wrong. Please try again.');	
redirect('http://localhost/detsci/index.php/Expenses/manage');	
}
	}
// For adding expenses
public function add($uid,$edate,$item,$icost){
$data=array(
'UserId'=>$uid,
'ExpenseDate'=>$edate,
'ExpenseItem'=>$item,
'ExpenseCost'=>$icost
);
$query=$this->db->insert('tblexpense',$data);
if($query){
$this->session->set_flashdata('success','Expense added successfully.');	
redirect('Expenses/add');
} else {
$this->session->set_flashdata('error','Something went wrong. Please try again.');	
redirect('Expenses/add');	
}
}
//For Manage Expenses
public function manage($uid)
{
	$wherecond ="(";
	$wherecond .="  ExpenseDate>='" . date('Y-m-01') . "' and ExpenseDate<='" .  date('Y-m-d') . "'";
$wherecond .=")";
	$query=$this->db->select('ExpenseDate,ExpenseItem,ExpenseCost,NoteDate,ID')
	   //  ->where('UserId',$uid)
	     ->where($wherecond)
	     ->get('tblexpense');
	     return $query->result();
}
public function manage1($uid,$s_item,$s_sd,$s_ed)
{
	//$cond=" 1=1 ";
	$cond="";
	// if(isset($uid) && $uid!=''){
	// 	$cond.="  UserId='" . $uid . "'";
	// }
	if(isset($s_item) && $s_item!=''){
		$cond.=" ExpenseItem='" . $s_item . "'";
	}
	// if((isset($s_sd) && $s_sd!='') && (isset($s_ed) && $s_ed!='')){
	// 	$cond.=" and ExpenseDate>='" . $s_sd . "' and ExpenseDate<='" . $s_ed . "'";
	// }
	$cond.="(".$cond.")";
	//$array = array('UserId' => $uid,'ExpenseItem' => $s_item,'ExpenseDate >=' => $s_sd,'ExpenseDate <=' => $s_ed);
	//$array = array('ExpenseDate >=' => $s_sd,'ExpenseDate <=' => $s_ed);
	//$wherecond = "( ( ( UserId ='" . $uid . "' OR ExpenseItem='" . $s_item . "') AND (ExpenseDate='" . $s_sd . "') ) )";
	// $wherecond = "(ExpenseItem='" . $s_item . "')";
	//$wherecond = "(ExpenseItem='" . $s_item . "' and ExpenseDate>='" . $s_sd . "' and ExpenseDate<='" . $s_ed . "')";
$wherecond ="(";
if(isset($s_item) && $s_item!=''){
 $wherecond .="ExpenseItem like '%" . $s_item . "%'";
}
if(isset($s_item) && $s_item!='' && isset($s_sd) && $s_sd!='' && isset($s_ed) && $s_ed!=''){
	$wherecond .=" and ExpenseDate>='" . $s_sd . "' and ExpenseDate<='" . $s_ed . "'";
	}else{
		if(isset($s_sd) && $s_sd!='' && isset($s_ed) && $s_ed!=''){
	$wherecond .=" ExpenseDate>='" . $s_sd . "' and ExpenseDate<='" . $s_ed . "'";
	}	
}
$wherecond .=")";
	$query=$this->db->select('ExpenseDate,ExpenseItem,ExpenseCost,NoteDate,ID')
	    // ->where($array)
	->where($wherecond)
	//->where($cond)
	     ->get('tblexpense');
	     return $query->result();
}

// For expense Deletion
public function delete($uid){
$query=$this->db->where('ID',$uid)
                ->delete('tblexpense');
}
//getexpense
public function getexpensedetails($uid)
{
	$query=$this->db->select('ExpenseDate,ExpenseItem,ExpenseCost,NoteDate,ID')
	     ->where('ID',$uid)
	     ->get('tblexpense');
	     return $query->result();
}

}