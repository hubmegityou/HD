              
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
            
    a to ma niby postem odpalac notifications.php i zwracac wynik do zmiennej liczba 