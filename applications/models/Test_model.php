<?php

class Test_model extends PC_Model {
	function test(){
		// test load librari
		$this->load->library('test_lib');
		return $this->test_lib->test();
	}
}