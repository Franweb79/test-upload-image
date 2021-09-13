/*
  https://stackoverflow.com/questions/29458705/ajax-request-with-bootstrap-modal-in-php

*/

$('#myButton').on('click', function () {
    
    $.ajax({

      type:'POST',
      dataType:'json',
      url:'controllers/get_user_data_controller.php',//as from the index.php, the url
      data: 'hola',
      success:function(dataReturned){
        console.log ("success");
        console.log(dataReturned);//an array with results
        console.log(dataReturned.length);
        console.log(typeof(dataReturned));

        /*
          if array returned from backend is empty, "no result"+
          if it has data, we iterate over data and add to a variable which will be
          shown on the modal
        */
        if(dataReturned.length===0)
        {
          $('#exampleModalBody').html("no result");
         // alert("e");
        }
        else{

          $('#exampleModalBody').html(function(){

            let allHTML="<ul>";

            //gets the server url
           let serverUrl= window.location.origin;

           let imagePath=`${serverUrl}/test_upload_image/imagenes`;
            
            dataReturned.forEach(element => {
              allHTML+=`<li>${element['nick']}</li>
              <li><img src=${imagePath}/${element['foto']} alt=${element['foto']} width="200" height="200"/></li><br/> ` ;
              
            });

            allHTML+="</ul>";
  
            return allHTML;
  
          });

        }

       
        
        
          //dataReturned[0]['nick']);

        
      },
      error:function(error){
        console.log (JSON.stringify(error));
      }


    });
  })