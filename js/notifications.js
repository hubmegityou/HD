              

    window.onload= function getNotifications(){
      
              
           $.ajax({
            type:"GET", 
            url:"notifications.php", 
            contentType:"application/json; charset=utf-8", 
            dataType:'json', 
             
                success: function(json) { 
                       
                 document.getElementById('circle').innerHTML=json;
                
                
                }
              });
          
            setTimeout(function(){
            getNotifications();
            }, 17000);
    
    }   
                
                