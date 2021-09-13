
<?php

    
    error_reporting(E_ALL);
    ini_set("display_errors", 1);

    include 'models/Usuario.php';
    /* 
    
        we need it to show alerts and such, 
        depending if user is being newly created or not
    */
    session_start();



?>

<!doctype html>

<html lang="en">
    
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Basic show image program with PHP and vanilla JS</title>
    <meta name="description" content="A simple HTML5 Template for new projects.">
    <meta name="Fran Prieto" content="avanzartewebs.com">

    

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    



    </head>

    <body>


        <?php
            if(isset($_SESSION) && isset($_SESSION['alert']) && $_SESSION['alert']=="green" ){
        ?>
                <div class="alert alert-success" role="alert">
                user successfully created
                </div>
        <?php

                /*
                    once alert is shown, we unset it to avoid being shown again
                    when new user isn´t created
                */
                    unset ($_SESSION['alert']);
                
            }

            
                

        ?>
        

        <?php 
        
            /*
            
                the form must have the enctype="multipart/form-data" or 
                won´t qork to upload the image 
            
                More info:

                https://www.php.net/manual/es/features.file-upload.post-method.php
            
            */

        ?>
        <form method="post" enctype="multipart/form-data" action="controllers/crearUsuario.php">

            nombre: <input type="text" name="name"/>

            <label for="avatar">Choose a profile picture:</label>

            <input type="file"
            id="avatar" name="avatar"
            accept="image/png, image/jpeg">

            <input type="submit" value="enviar"/>
        </form>

            

        <!-- Button trigger modal -->
        <!--<button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal</button>-->

        <button type="button" id="myButton" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal</button>


        


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="exampleModalBody">

                    <?php
                       // include 'controllers/get_user_data_controller.php';
                        include 'views/view_user_data.php';

                        
                        
                        if( isset($_SESSION) && isset($_SESSION['users']) )
                        {
                            print_r($_SESSION['users']);
                        }else{
                            echo "no results";
                        }
                    ?>
                    ...<!-- TODO meter a una sesion lops resultados de usuarios, y si no hay "no data"-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>


        <!--always must include jquery before bootsrap js to make modals work-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
        <script src="assets/scripts.js"></script>

    </body>
</html>





 