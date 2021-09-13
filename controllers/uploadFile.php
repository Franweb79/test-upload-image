<?php
	
	/* https://www.w3schools.com/php/php_file_upload.asp */
	
	//require '../models/Conectar.php'; 

	require '../models/Usuario.php';

	

	
	 /*
	 
	 	I need to recover the session in order to store 
		 the flag and show a proper message

	*/
	
	session_start(); 
	
	
	
	
	$target_dir="../imagenes/"; /*$target_dir - specifies the directory where the file is going to be placed*/
	//echo $target_dir;
	

	/*

		https://www.w3schools.com/php/func_filesystem_basename.asp

		 The basename() function returns the filename from a path.

		 $_FILES

		 https://www.php.net/manual/es/features.file-upload.post-method.php

		 $_FILES['the inputname'][`the field name of the $_FILES array: name, size...]
'	*/
	$fileName=basename($_FILES['avatar']['name']); 
	
	// "../imagenes/carolina.jpg" 
	$targetFile=$target_dir.basename($_FILES['avatar']['name']);
	
	var_dump($_FILES['avatar']['name']);
	var_dump($targetFile);
	
	
	/*
		this will allow only certain image file types, to avoid other image or file types like pdf
		https://www.w3schools.com/php/func_filesystem_pathinfo.asp

		this will allow us to get the file extension with the help of the
		PATHINFO_EXTENSION
	*/
	$fileType=pathinfo($targetFile,PATHINFO_EXTENSION); 
	
	$fileSize=basename($_FILES['avatar']['size']);/*to evalute the size*/
	
	//../imagenes/carolina.jpg
	//echo $target_dir.basename($_FILES['avatar']['nick'])."<br/>";
	
	//../imagenes/carolina.jpg
	//echo $target_dir.$_FILES['avatar']['nick']."<br/>";
	
	
	
	/*this method will copy the specified file on first parameter, to the location of second parameter*/
	/*but we must use the tmp_name, beuase uploades file will be stores in temporary location*/
	
	/* https://stackoverflow.com/questions/18929178/move-uploaded-file-function-is-not-working */
	
	if($fileType != 'jpg' && $fileType != 'jpeg') /*we evaluate if type is right (only certain image file types allowed)*/
	{
		
		/*f the extension is not correct, we send it back to modDatos and there we validate that it shows that it is wrong*/
		
		/*this session data will travel from principal.php to the view_vista_principal.php and there it will show that alert with the

			appropiate validation*/
		
		$_SESSION['bandera']="orange";//LO PODEMOS MANDAR AL INDEX Y QUE ALLI MUESTRE LA BANDERA DE ERROR
		
		header('Location: ../index.php');
	
	}
	
	elseif($fileSize>50000)/*if size is more than 50KB, no*/
	{
		$_SESSION['bandera']="blueviolet";
		
		header('Location: ../index.php');

		
		
		
	}
	
	else/*if extension is right and size is less or equel than required, we insert user and upload*/
	{
			
		$user=new Usuario();

		$user->insertUser($_POST['nick'],$_FILES['avatar']['name']);

		//$_SESSION['usuario']->foto=$fileName;/*esto lo pasa solo a la sesion, no a la bbdd! hay q hacer consulta*/

			/*
				https://www.w3schools.com/php/func_filesystem_move_uploaded_file.asp

			*/
		
		move_uploaded_file($_FILES['avatar']['tmp_name'],$targetFile);
	
	
		//$usuario=new Usuario();

		/*
			TODO miramos desde por aqui, ya podemos crear el user con los datos delform
			and upload picture to imagenes
			ahora hay que hacer que en una paginas de view usuario de vea nombre y foto.
		*/
	
		/*
			ESTO ES SI LA CAMBIAMOS CON EL USER YA CREADO, en ese caso habra
			que meter alguna logica porque vamos a incluir este php tanto para crear user como 
			para updatearlo (en la session, un S_session[new_user] o algo asi, y si no es nuevo usuario
			porque es en el update, pues eso) 
		
			$usuario->cambiarFotoUsuario($_SESSION['usuario']->nick,$fileName);
		*/
		$_SESSION['alert']="green";/*to say it is correctly uploaded on a flag alert, the same used to say the other data is succesfully updated
		
		/*
			the green alert is show in the view_user_data section, 
			that will be include on the index.php if we have 
			a $_SESSION['bandera']="green" (we have to destroy it after shown, remember)
		*/
	
		header('Location: ../index.php');

		
	}
	

?>