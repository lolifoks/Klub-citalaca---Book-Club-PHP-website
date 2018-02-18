<?php
	$ime_servera = "localhost";
	$kor_ime = "root";
	$lozinka = "";
	
	$konekcija = mysqli_connect($ime_servera, $kor_ime, $lozinka, 'book_club');
	
	
	$greske = array();
	
	if(!$konekcija)
	{
		$greske[] = "Greska prilikom konekcije sa serverom baze podataka! ".mysql_error();
	}
	
	
	
	mysqli_set_charset($konekcija, "utf8");
	
	
	
	
	
?>