<?php 
class Devices extends Database{

	function Devices(){
		$this->Database();
	}
	public function formatToArray($data){
		$array ="";
		for($i=0;$i<sizeof($data);$i++)
			$array[$i] = $data[$i]['userAgent'];
		return $array;
	}
	public function getListDevicesAllUser(){
		$query = "SELECT * FROM devices";
		$data =  $this->execute($query);
		while($device = mysqli_fetch_assoc($data)){
			$devices[] = $device;
		}
		return $this->formatToArray($devices);
	}
	public function isExistDevice($currentDevice,$userId){
			$devicesList = $this->getListDevicesOneUser($userId);
			for($i=0;$i<sizeof($devicesList);$i++)
				if(strcmp($currentDevice,$devicesList[$i])) return 1;
			return 0;
	}

	public function createDevice($currentDevice,$id){
		$query = "INSERT INTO devices(id,userAgent,userid) VALUES(null,'$currentDevice',$id)";
		return $this->execute($query);
	}

	public function getListDevicesOneUser($userId){
		$query = "SELECT * FROM devices WHERE  userid=$userId";
		$data =  $this->execute($query);
		while($device = mysqli_fetch_assoc($data)){
			$devices[] = $device;
		}
		return $this->formatToArray($devices);
	}
}
?>

