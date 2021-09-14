<?php
	
	/* https://www.w3schools.com/php/php_file_upload.asp */
	
	//require '../models/Conectar.php'; 

	require '../models/Usuario.php';

	

	
	 /*
	 
	 	I need to recover the session in order to store 
		the alert and show a proper message is user is successfully registered or not

	*/
	
	session_start(); 
	
	
	
	
	$target_dir="../imagenes/"; /*$target_dir - specifies the directory where the file is going to be placed*/
	
	

	/*

		https://www.w3schools.com/php/func_filesystem_basename.asp

		 The basename() function returns the filename from a path.

		 $_FILES

		 https://www.php.net/manual/es/features.file-upload.post-method.php

		 $_FILES['the inputname'][`the field name of the $_FILES array: name, size...]
'	*/
	$fileName=basename($_FILES['avatar']['name']); 
	
	
	$targetFile=$target_dir.basename($_FILES['avatar']['name']);
	
	var_dump($_FILES['avatar']['name']);
	var_dump($targetFile);
	
	
	/*
		we will allow only certain image file types, to avoid other image or file types like pdf
		https://www.w3schools.com/php/func_filesystem_pathinfo.asp

		to do that, we will ise pathinfo(), which will allow us to get the file extension with the help of the
		PATHINFO_EXTENSION
	*/
	$fileType=pathinfo($targetFile,PATHINFO_EXTENSION); 
	
	$fileSize=basename($_FILES['avatar']['size']);/*to evalute the size*/
	

	
	/* 
		we evaluate if type is right (only certain image file types allowed)

		If the extension or size -validated on the elseif-, is not correct, we send it back to index.php
		and there we will show the proper message

		To do that we create a $_SESSION['alert'] variable
		

	*/
	
	if($fileType != 'jpg' && $fileType != 'jpeg') /**/
	{
		
		
		$_SESSION['alert']="red";
		
		header('Location: ../index.php');
	
	}
	
	elseif($fileSize>50000)/*if size is more than 50KB*/
	{
		$_SESSION['alert']="red";
		
		header('Location: ../index.php');

		
		
		
	}
	
	else/*if extension is right and size is less or equal than required, we insert user and upload file*/
	{
			
		$user=new Usuario();

		$user->insertUser($_POST['nick'],$_FILES['avatar']['name']);


		/*
			https://www.w3schools.com/php/func_filesystem_move_uploaded_file.asp

			this method will copy the specified file on first parameter, to the location of second parameter

			I had some problems that I solved with this help: 
			
			https://stackoverflow.com/questions/18929178/move-uploaded-file-function-is-not-working 


		*/

		
		move_uploaded_file($_FILES['avatar']['tmp_name'],$targetFile);
	
		/*
			to say to index.php user is succ. registered, we also use the session variable 
		*/
		$_SESSION['alert']="green";
		
		
	
		header('Location: ../index.php');

		
	}
	

?>