<?php

class Rimplenet_Base_Auth_Api {


	public function __construct() {
		$this->load_required_files();
	}

    private function load_required_files() {
   	 //Add Required Files to Load
	 require_once plugin_dir_path( dirname( __FILE__ ) ) . 'auth/authorization.php';
    }
	
}


$Rimplenet_Base_Auth_Api = new Rimplenet_Base_Auth_Api();