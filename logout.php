<?php
	@session_start();
	if(isset($_SESSION['idR']))
	{
		unset($_SESSION['idR']);
		unset($_SESSION['username']);
		
		session_destroy();
		header('Location: index.php');
	}
?>