<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_emp extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('hris/employee_m');
	}

	public function index()
	{
		$data['title']='Master Employee';
		$data['sub_title']='List Employee';
		$data['page']='hris/master_emp_v';

		$this->load->view('template_2',$data);		
	}

	function emp_list(){
		$qry =$this->employee_m->employee_list();

		$i=1;
		foreach ($qry->result() as $rows) {

			$row=[];
			$row[] = $i;
			$row[] = '<img src="'.base_url("assets/images/employee/").$rows->photolink.'" height="50px">';
			$row[] = $rows->emp_id;
			$row[] = $rows->emp_name;
			$row[] = $rows->address;
			$row[] = '<span class="btn btn-sm btn-warning waves-effect" onclick="update_emp(\''.$i.'\',\''.$rows->emp_id.'\',\''.$rows->emp_name.'\')"><i class="glyphicon glyphicon-plus"></i>EDIT</span>';
			$row[] = '<span class="btn btn-sm btn-danger waves-effect" onclick="delete_emp(\''.$i.'\',\''.$rows->emp_id.'\',\''.$rows->emp_name.'\')">DEL</span>';
			$row[] = '';

			$data[]=$row;
		$i++;
		}
		echo json_encode(['data' => $data]);		
	}

	function save_emp(){
		$emp_id=$this->input->post('emp_id');

		$data=[
			'emp_id'=>$this->input->post('emp_id'),
			'emp_name'=>ucwords(strtolower($this->input->post('emp_name')))
		];

		$this->employee_m->save_master($data,$emp_id);
		// $this->employee_list();		
	}

}

/* End of file Master_emp.php */
/* Location: ./application/controllers/hris/Master_emp.php */