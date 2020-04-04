<?php  
class Users extends Database{
	protected $username;
	protected $fullname;
	protected $password;
	protected $role;
	public $currentDevice;
	protected $userId;
	function Users($username,$password){
		$this->Database();
		$this->username =$username;
		$this->password =$password;

		if($this->Login()==1){
			if($this->role) $this->setCurrentDevice();
			$this->showAllDevices();
		}
		else echo "Sai pass";
	}
	function Login(){
		$query = "SELECT * FROM user WHERE user='$this->username' AND password='$this->password'";
		$result = $this->execute($query)->fetch_assoc();
		if($result) {
			$this->updateInfoUser($result);
			return 1;
		}
		return -1;
	}
	function showAllDevices(){
		require_once 'Devices.php';
		$Devices = new Devices();		
		if($this->role==1){
			if($Devices->isExistDevice($this->currentDevice,$this->userId)==0){
				$Devices->createDevice($this->currentDevice,$this->userId);
			}
			$this->printDevices($Devices->getListDevicesOneUser($this->userId));
			
		}
		else $this->printDevices($Devices->getListDevicesAllUser());	
	}
	function printDevices($devicesList){
		for($i=0;$i<sizeof($devicesList);$i++)
			echo ($i+1) . $devicesList[$i].'<br>';
	}
	function setCurrentDevice(){
		$this->currentDevice = $_SERVER['HTTP_USER_AGENT'];
	}
	function updateInfoUser($info){
		$this->role = $info['role'];
		$this->fullname = $info['fullname'];
		$this->userId = $info['id'];
	}
}
?>