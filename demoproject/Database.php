<?php  
class Database{	
	private $hostname  = 'localhost';
	private $user      = 'root';
	private $pwd       = '';
	private $dbname    = "demoproject";
	private $connect = NULL;
	private $result = NULL;
	public function Database(){
		$this->connect = new mysqli($this->hostname,$this->user,$this->pwd,$this->dbname);
		if(!$this->connect){
			echo 'databaes failed';
			return -1;
		}
		else{
			mysqli_set_charset($this->connect,"utf8");
			return $this->connect;
		}
	}
	public function execute($sql){
		$this->result = $this->connect->query($sql);
		return $this->result;
	}
}
?>