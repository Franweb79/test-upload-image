<?php

	
	
	require_once "Usuario.php";
	
	
	 
	class Conectar
	{
		//constantes con los datoss que vamos a usar para conectar a la bbdd avanzar1_avanzar1_frapri1_redsoc
		
		
		public $host="localhost";
		public $user="root";
		public $pass=""; //I must put it with no encryption!!
		public $nombreBase="test-upload-image";
		
		public $conexion;
		
		
		
		
		
		function __construct()
		{
			//$this->crearConexion();
		}
		
		function crearConexion()
		{
			try{

				$this->conexion = new PDO("mysql:host=$this->host;dbname=$this->nombreBase", $this->user, $this->pass);

				 // set the PDO error mode to exception
  				$this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				//var_dump($this->conexion);

			}catch(PDOException $e){
				echo $e->getMessage();
			}

			//var_dump($this->conexion);
		}

		function cerrarConexion(){
			$this->conexion=null;

			//echo "conn closed";

			//echo $this->conexion;
		}
		
		
		
		
		
		
	}//conectar	
		
		
	
		
		
?>