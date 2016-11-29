<?php

class PC_Model {
	public function __get($key){
		return get_instance()->$key;
	}
}
