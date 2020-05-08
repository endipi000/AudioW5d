<?php
class Home_Models extends DB{ 
 	public $db;
	public function __construct() {
		$this->db = new DB('localhost','taoaudio','taoaudio','taoaudio'); 
	}  
}
?>