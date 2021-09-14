<?php

	require 'Conectar.php';

	class Usuario
	{
	
	
		public $nick;
		public $foto;
		
				



		/*function __construct($foto)
		{
			$this->nick;
			$this->foto=$foto;
			
		}*/
		
		
		
		function __toString()
		{
			$textoADevolver="
			nick ".$this->nick ."</br>
			foto: ".$this->foto."</br>";
			
?>		
			
			
			
<?php			
			
			

			
			
			
			return $textoADevolver;
		
		
		}

		function insertUser($nickUsuario,$stringFoto){

			

			$sql="insert into usuarios (nick,foto) VALUES (:nickUser,:stringFoto)";

			try{

				$connObject=new Conectar();

				//we create the connection on the "conexion" property of the class $connObject
				$connObject->crearConexion();

				// prepare sql and bind parameters

				$stmt=$connObject->conexion->prepare($sql);
				$stmt->bindParam(':nickUser', $nickUsuario);
				$stmt->bindParam(':stringFoto', $stringFoto);

				$stmt->execute();

				
				$connObject->cerrarConexion();

			}catch(PDOException $e){
				echo $e->getMessage();
			}
			


		}

		/*this will used if we allow to change user profile picture*/
		
		function cambiarFotoUsuario($nickUsuario,$stringFoto)
		{

			$sql="UPDATE usuarios
			
					SET foto=:foto
					
					WHERE nick=:nick";
			
			try{

				$connObject=new Conectar();

				$connObject->crearConexion();
			
				

				$stmt=$connObject->conexion->prepare($sql);

				// prepare sql and bind parameters
				$stmt->bindParam(':nick', $nickUsuario);
				$stmt->bindParam(':foto', $stringFoto);

				$stmt->execute();

				$connObject->cerrarConexion();


			}catch(PDOException $e){
				echo $e->getMessage();
			}
			
			
			
			if (mysqli_query($this->conexion, $consulta)) 
			{
				//echo "Record updated successfully";
			} 
			else 
			{
				echo "Error updating record: " . mysqli_error($conexion);
			}
			
			$this->cerrarConexion();
			
		}

		
		//TODO should be also done with PDO
		function getAllUsers()
		{
			try{
				
				
				$connObject=new Conectar();

				//we create the connection on the "conexion" property of the class $connObject
				$connObject->crearConexion();

				
				
				$consulta="select * from usuarios";

				$stmt=$connObject->conexion->prepare($consulta);

				$stmt->execute();
				
				
				$result = $stmt->fetchAll();

				
			
				$connObject->cerrarConexion();
				
				/*
					remember on php, we can´t use return to send data to the front-end,
					must be echo (strings and so) or print_r(arrays and so)
					the json encode is to convert the array to JSON format. it can be read
					by $.ajax with no more conversion needed
				*/
				print_r(json_encode($result));




			}catch(PDOException $e){
				echo $e->getMessage();
			}
			
			
			
			
			
			
			
			
		}

		
		
		


		function getUsuario($nickDelUsuario,$passDelUsuario)
		{
		
			$this->crearConexion();
			
			$consulta="select * from vistanombreroljoin where vistanombreroljoin.nick='".$nickDelUsuario."' and vistanombreroljoin.pass='".$passDelUsuario."'"; 
			
			
			$resultado=mysqli_query($this->conexion,$consulta);
			
			//como solo va a devolver una fuila, no hace falta while
			
			$fila=mysqli_fetch_assoc($resultado);
			
			/*if($fila==false)
			{
			
			
				echo "NO HAY FILAS CON ESE NICK";
			}
			else
			{*/
			if($fila !=false)
			{
				extract($fila);
			
				$userAMostrar=new Usuario($nick,$nombre_rol,$pass,$nombre,$apellidos,$direccion,$telefono,$correo,$foto,$sexo,$orientacion);
				
				$this->cerrarConexion();
			}
			else
			{
				$userAMostrar=null;
			}
				
				return $userAMostrar;
				
			
				
			
				
				
				$this->cerrarConexion();
			
			//}
			
			
			//$this->cerrarConexion();
			
				
			
		
		}
	
	
	}//usuario


?>