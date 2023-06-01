<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Revenue extends CI_Controller {
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
$this->form_validation->set_rules('revenuedate','Revenue date','required');
$this->form_validation->set_rules('item','Item','required');
$this->form_validation->set_rules('costitem','Item Cost','required|numeric');
if($this->form_validation->run())
{
$edate=$this->input->post('revenuedate');
$item=$this->input->post('item');
$icost=$this->input->post('costitem');
$remarks=$this->input->post('remarks');
$uid=$this->session->userdata('uid');	
$this->load->model('Revenue_Model');
$this->Revenue_Model->updaterevenue($eid,$uid,$edate,$item,$icost,$remarks);
} else{
$this->session->set_flashdata('success','Revenue info updated successfully.');
redirect('Revenue/manage');
}
}
//Function for adding revenue
public function add(){
//form validation
$this->form_validation->set_rules('revenuedate','Revenue date','required');
$this->form_validation->set_rules('item','Item','required');
$this->form_validation->set_rules('costitem','Item Cost','required|numeric');
if($this->form_validation->run())
{
$edate=$this->input->post('revenuedate');
$item=$this->input->post('item');
$icost=$this->input->post('costitem');
$remarks=$this->input->post('remarks');
$uid=$this->session->userdata('uid');	
$this->load->model('Revenue_Model');
$this->Revenue_Model->add($uid,$edate,$item,$icost,$remarks);
} else{
$this->load->view('add-revenue');
}
}
// Manage revenue
public function manage(){
$uid=$this->session->userdata('uid');
$this->load->model('Revenue_Model');
$revdetails=$this->Revenue_Model->manage($uid);	
$this->load->view('manage-revenue',['revenuedetails'=>$revdetails]);
}
//Delete revenue
public function delete($uid){
$this->load->model('Revenue_Model');
$this->Revenue_Model->delete($uid);
$this->session->set_flashdata('success','Revenue Record deleted');
redirect('Revenue/manage');
}
public function getrevenue()
    {
		$id   = $_POST['id'];
		$this->load->model('Revenue_Model');
		$dataddd=$this->Revenue_Model->getrevenuedetails($id);
		//$dataddd= $this->getrevenuedetails($id);
        $this->load->view("revenue-modal.php",['data'=>$dataddd]);

    }
    //editdata
      public function editdata($uid){
		//$data['viewdetails']=$this->usecategory->categoryList();
		$this->load->model('Revenue_Model');
		$data['editdata']=$this->Revenue_Model->getrevenuedetails($uid);
		$this->load->view('update-revenue',$data);	
		}

}