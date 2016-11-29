<?php

class welcome extends PC_Controller {
	function index(){
		// Test load model
		$this->load->model('Test_model');
		$data['test'] =  $this->test_model->test();

		$this->load->view('welcome', $data);
	}
}