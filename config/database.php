<?php

class Database
{
	public $db;

	function __construct()
	{
		try {
			//$this -> db = new PDO( dsn :"mysql:host=localhost;dbname=api;charset=UTF8",username:"root", passwd:"");
			$this -> db = new PDO('mysql:host=localhost;dbname=api;charset=UTF8', "root","");
			//$this -> db  = new mysqli('127.0.0.1', 'root', '', ''); 

		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	
}
