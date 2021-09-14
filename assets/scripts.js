/*
  https://stackoverflow.com/questions/29458705/ajax-request-with-bootstrap-modal-in-php

*/

$('#myButton').on('click', function () {
    
    $.ajax({

      type:'POST',
      dataType:'json',
      url:'controllers/get_user_data_controller.php',//this will be called from the index.php, so the url must be like it we were on index.php
      success:function(dataReturned){
        

        /*
          if array returned from backend (dataReturned) is empty, we set 
          the text shown in modal to "no result"
          if array has data, we iterate over data and add each element to a variable which will be
          shown on the modal
        */
        if(dataReturned.length===0)
        {
          $('#exampleModalBody').html("no result");
         
        }
        else{

          $('#exampleModalBody').html(function(){

            let allHTML="<table class='table table-success table-striped'>";

          /*gets the server url. 
          
            THIS WILL WORK ON DEVELOPMENT
            
            BUT NOT ON PRODUCTION, BETTER SIMPLY DO IMAGENES/

            YOU NEED NO SERVER URL OR FOLDER NAME ON THE SRC

            let serverUrl= window.location.origin;

            let imagePath=`${serverUrl}/test-upload-image/imagenes`;

          */

           let imagePath=`imagenes`;
            
            dataReturned.forEach(element => {
              allHTML+=`<tr><td><b>${element['nick']}</b></td>
              <td><img src=${imagePath}/${element['foto']} alt=${element['foto']} width="200" height="200"/></td></tr> ` ;
              
            });

            allHTML+="</table>";
  
            return allHTML;
  
          });

        }

        
      },
      error:function(error){
        console.log (JSON.stringify(error));
      }


    });
  })