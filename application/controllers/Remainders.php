<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Remainders extends CI_Controller {
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
			$rid=$this->input->post('id');
$this->form_validation->set_rules('remainder_date','Remainder date','required');
$this->form_validation->set_rules('item','Item','required');
$this->form_validation->set_rules('costitem','Item Cost','required|numeric');
if($this->form_validation->run())
{
$edate=$this->input->post('remainder_date');
$item=$this->input->post('item');
$icost=$this->input->post('costitem');
$remarks=$this->input->post('remarks');
$uid=$this->session->userdata('uid');	
$this->load->model('Remainders_Model');
$this->Remainders_Model->update_remainder($rid,$uid,$edate,$item,$icost,$remarks);
} else{
$this->session->set_flashdata('success','Remainder info updated successfully.');
redirect('Remainders/manage');
}
}
//Function for adding remainder
public function add(){
//form validation
$this->form_validation->set_rules('remainder_date','Remainder date','required');
$this->form_validation->set_rules('item','Item','required');
$this->form_validation->set_rules('costitem','Item Cost','required|numeric');
if($this->form_validation->run())
{
$edate=$this->input->post('remainder_date');
$item=$this->input->post('item');
$icost=$this->input->post('costitem');
$remarks=$this->input->post('remarks');
$uid=$this->session->userdata('uid');	
$this->load->model('Remainders_Model');
$this->Remainders_Model->add($uid,$edate,$item,$icost,$remarks);
} else{
$this->load->view('add-remainder');
}
}
// Manage remainder
public function manage(){
$uid=$this->session->userdata('uid');
$this->load->model('Remainders_Model');
$remainder_details=$this->Remainders_Model->manage($uid);	
$this->load->view('manage-remainders',['remainder_details'=>$remainder_details]);
}
//Delete remainder
public function delete($uid){
$this->load->model('Remainders_Model');
$this->Remainders_Model->delete($uid);
$this->session->set_flashdata('success','Remainder Record deleted');
redirect('Remainders/manage');
}
public function get_remainder()
    {
		$id   = $_POST['id'];
		$this->load->model('Remainders_Model');
		$dataddd=$this->Remainders_Model->get_remainder_details($id);
		//$dataddd= $this->get_remainder_details($id);
        $this->load->view("remainder-modal.php",['data'=>$dataddd]);

    }
    //edit_data
      public function edit_data($uid){
		//$data['viewdetails']=$this->usecategory->categoryList();
		$this->load->model('Remainders_Model');
		$data['edit_data']=$this->Remainders_Model->get_remainder_details($uid);
		$this->load->view('update-remainder',$data);	
		}

}