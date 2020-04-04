<?php
require_once 'Database.php';
require_once 'Users.php';
require_once 'Devices.php';
session_start();
	
		$User = new Users("user1","123");
		echo $User->currentDevice;
session_destroy();		
?>