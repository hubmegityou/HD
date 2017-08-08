function deleteST(id, typ){
    

       if (window.XMLHttpRequest){
            xmlhttp=new XMLHttpRequest();
        }

       else{
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }

    var PageToSendTo = "delete_st.php?";
    var IDPlaceholder = "id=";
    var TYPPlaceholder = "typ=";
    
    var UrlToSend = PageToSendTo + IDPlaceholder + id + '&' + TYPPlaceholder + typ;

    xmlhttp.open("GET", UrlToSend, false);
    xmlhttp.send();
    window.location.href = "team_tasks.php";

 }