function deleteTask(id){
    

       if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }

       else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

    var PageToSendTo = "delete_task.php?";
    var IDPlaceholder = "id=";
    
    var UrlToSend = PageToSendTo + IDPlaceholder + id ;

    xmlhttp.open("GET", UrlToSend, false);
    xmlhttp.send();
    window.location.href = "team_tasks.php";

 }