<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Expenses extends CI_Controller {
//Validating login
function __construct(){
parent::__construct();
if(!$this->session->userdata('uid'))
redirect('login');
}
//edit
	public function newupdate()
	{
	
//form validation
			$eid=$this->input->post('id');
$this->form_validation->set_rules('expensedate','Expense date','required');
$this->form_validation->set_rules('item','Item','required');
$this->form_validation->set_rules('costitem','Item Cost','required|numeric');
if($this->form_validation->run())
{
$edate=$this->input->post('expensedate');
$item=$this->input->post('item');
$icost=$this->input->post('costitem');
$uid=$this->session->userdata('uid');	
$this->load->model('Expenses_Model');
$this->Expenses_Model->updateexpense($eid,$uid,$edate,$item,$icost);
} else{
$this->session->set_flashdata('success','Expense info updated successfully.');
redirect('Expenses/manage');
}
}
//Function for adding expenses
public function add(){
//form validation
$this->form_validation->set_rules('expensedate','Expense date','required');
$this->form_validation->set_rules('item','Item','required');
$this->form_validation->set_rules('costitem','Item Cost','required|numeric');
if($this->form_validation->run())
{
$edate=$this->input->post('expensedate');
$item=$this->input->post('item');
$icost=$this->input->post('costitem');
$uid=$this->session->userdata('uid');	
$this->load->model('Expenses_Model');
$this->Expenses_Model->add($uid,$edate,$item,$icost);
} else{
$this->load->view('add-expense');
}
}
// Manage Expenses
public function manage(){
$uid=$this->session->userdata('uid');
$this->load->model('Expenses_Model');
if((isset($_POST['s_item']) && $_POST['s_item']!='') || (isset($_POST['s_sd']) && $_POST['s_sd']!='')  || (isset($_POST['s_ed']) && $_POST['s_ed']!='')){
	$s_item   = $_POST['s_item'];
	$s_sd   = $_POST['s_sd'];
	$s_ed   = $_POST['s_ed'];
	$expdetails=$this->Expenses_Model->manage1($uid,$s_item,$s_sd,$s_ed);	
}else{
	$expdetails=$this->Expenses_Model->manage($uid);	
}

$this->load->view('manage-expense',['expensedetails'=>$expdetails]);
}
//Delete Expenses
public function delete($uid){
$this->load->model('Expenses_Model');
$this->Expenses_Model->delete($uid);
$this->session->set_flashdata('success','Expense Record deleted');
redirect('Expenses/manage');

}
public function getexpense()
    {
		$id   = $_POST['id'];
		$this->load->model('Expenses_Model');
		$dataddd=$this->Expenses_Model->getexpensedetails($id);
		//$dataddd= $this->getexpensedetails($id);
        $this->load->view("modal.php",['data'=>$dataddd]);

    }
    //editdata
      public function editdata($uid){
		//$data['viewdetails']=$this->usecategory->categoryList();
		$this->load->model('Expenses_Model');
		$data['editdata']=$this->Expenses_Model->getexpensedetails($uid);
		$this->load->view('update-expense',$data);	
		}

}