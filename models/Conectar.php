<?php

	
	
	require_once "Usuario.php";
	
	
	 
	class Conectar
	{
		
		
		public $host="localhost";
		public $user="root";
		public $pass=""; //I must put it with no encryption!!
		public $nombreBase="test-upload-image";
		
		public $conexion;
		
		
		
		
		
		function __construct()
		{
			//$this->crearConexion();
		}
		
		/*
			we use PDO to avoid SQL injections and make back-end more secure
		*/
		function crearConexion()
		{
			try{

				$this->conexion = new PDO("mysql:host=$this->host;dbname=$this->nombreBase", $this->user, $this->pass);

				 // set the PDO error mode to exception
  				$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


			}catch(PDOException $e){
				echo $e->getMessage();
			}

		}

		function cerrarConexion(){
			$this->conexion=null;

			
		}
		
		
			
		
	}//conectar	
		
		
	
		
		
?>