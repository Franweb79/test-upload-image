<?php

    
    class Connection{

         private $host="localhost";
         private $user="avanzar1_franGod";
         private $pass="Fran*2018XEKUN";
         private $databasename="avanzar1_your_reminder";

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
        to be able to create truncates when there are foreign keys and so, 
        you must deactivate first and reactivate at the end

        https://tableplus.com/blog/2018/08/mysql-how-to-truncate-all-tables.html
        
    */
    function reset_all(){

        
        $sql="SET FOREIGN_KEY_CHECKS=0;
        
        TRUNCATE TABLE tareas;
        TRUNCATE table usuarios;
        
        SET FOREIGN_KEY_CHECKS=1;";

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

  
    


    reset_all();
 

    
    

?>