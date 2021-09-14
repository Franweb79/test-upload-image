<?php

    
    class Connection{

         private $host="localhost";
         private $user="avanzar1_franRedSoc";
         private $pass="My*2017VART3";
         private $databasename="avanzar1_frapri1_redsoc";

        /*no constructor for now*/

        public function connect(){

            // https://www.php.net/manual/en/pdo.connections.php
           $prepare_conn_str = "mysql:host=$this->host;dbname=$this->databasename";

           $conn = new PDO( $prepare_conn_str, $this->user, $this->pass );

           // https://www.php.net/manual/en/pdo.setattribute.php
           $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

           /*var_dump($conn);

           die();*/
           // return databaseconnection back
          return $conn;
        }


    

    }

    
    /*
    
        never truncate:
            -rs_roles
            -rs_estados
        it seems truncate views is possible like with a normal table

        remember set foreign checks to 0 at beginning and 1 at the end 
        to be able to truncate when there are foreign keys
    */ 
    function reset_items(){

        $sql="

            SET FOREIGN_KEY_CHECKS=0;
        
            TRUNCATE TABLE rs_amigos;
           
            TRUNCATE TABLE rs_publicaciones;
            TRUNCATE TABLE rs_solicitudes;
            TRUNCATE TABLE rs_solicitudes_pendientes;
            TRUNCATE TABLE usuarios;
            TRUNCATE TABLE vistanombreroljoin;
            TRUNCATE TABLE vista_solicitudes_pendientes;
            TRUNCATE TABLE vista_solicitud_estado
            
            SET FOREIGN_KEY_CHECKS=1;
            ";
        

        try{

            $conObj=new Connection();

            $conn=$conObj->connect();

            $executeSentence=$conn->exec($sql);
            


            //var_dump($executeSentence);

           // $sth =$conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

             /*execute is for prepared sentence*/
           // $sth->execute( array(':items' => $p_table_name) ) ;

            
           
            $conObj = null; // clear db object (close the connection)

           

        }catch(PDOException $ex){

            return "{'errormessage': . '$ex'}";

        }

    }

    function create_new_items(){


        $sql="INSERT INTO usuarios (nick, id_rol, pass, nombre, apellidos, direccion, telefono, correo, foto, sexo, orientacion)
        VALUES  ('Fran',2,'f6fbf220b5b0bef995a32624d7603a53','fran','prieto','Test Avenue',555987456,'franprietogutweb@gmail.com', 'gatoav.jpg', 'Man','Heterosexual')";
        try{

            $conObj=new Connection();

            $conn=$conObj->connect();

            $executeSentence=$conn->exec($sql);

            //var_dump($executeSentence);

           // $sth =$conn->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

             /*execute is for prepared sentence*/
           // $sth->execute( array(':items' => $p_table_name) ) ;

            
           
            $conObj = null; // clear db object (close the connection)

           

        }catch(PDOException $ex){

            return "{'errormessage': . '$ex'}";

        }
    }


    reset_items();

    create_new_items();
    

?>