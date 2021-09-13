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

				//we create a connection on the "conexion" property of the class $connObject
				$connObject->crearConexion();
				//var_dump($connObject->conexion);

				$stmt=$connObject->conexion->prepare($sql);
				// prepare sql and bind parameters
				$stmt->bindParam(':nickUser', $nickUsuario);
				$stmt->bindParam(':stringFoto', $stringFoto);

				$stmt->execute();

				


				$connObject->cerrarConexion();

			}catch(PDOException $e){
				echo $e->getMessage();
			}
			


		}

		/*dentro de uploadFile.php, esta funcion actualizara la foto en la BBDD*/
		
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

		
		
		//funcion para obtener datos de la base de datos
		function getAllUsers()
		{
			try{
				
				//needed to pass users to view_user_data.php
				//session_start(); 
				$connObject=new Conectar();

				//we create a connection on the "conexion" property of the class $connObject
				$connObject->crearConexion();

				//TODO haz esto con PDO Y CON AJAX,pero sin jquery asi ya d epaso repasamos algo parecido a my diary
				//https://code.tutsplus.com/es/tutorials/how-to-use-ajax-in-php-and-jquery--cms-32494
				
				$consulta="select * from usuarios";

				$stmt=$connObject->conexion->prepare($consulta);

				$stmt->execute();
				
				
				$result = $stmt->fetchAll();

				//if no results, we will show "no results" on view_user_data.php
				/*if(count($result)>0){
					$_SESSION['users']=$result;
				}else{
					unset($_SESSION['users']);
				}*/
				
				//print_r($result);//echo with array gives error
					
					
				
			
			
				$connObject->cerrarConexion();
				//var_dump(gettype($result));
				//die();
				//remember on php, no return, must be echo (strings and so) or print_r(arrays and so)
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