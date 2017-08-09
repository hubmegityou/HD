              
  var getNotifications = {
       getNotifications: function(){

    $.ajax({
        type: "POST",
        url: "notifications.php",
        data: dataString,
        success: function(liczba){
            document.getElementById('circle').innerHTML=liczba;

        }
    });
    
    setTimeout(function(){
            getNotifications();
        }, 17000);}

}



            