<?php
	include_once '../lib/Database.php';
	include_once '../helpers/Format.php';
?>

<?php

/**
 * 	Cart class start
 */
class Cart {
	
	private $db;
	private $fm;
	function __construct() {
		$this->db = new Database();
		$this->fm = new Format();
	}
?>