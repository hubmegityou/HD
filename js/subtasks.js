
    
  function hide(id){

    var div = document.getElementById('sh'+id);
    var div2=document.getElementById(id);

    if(div.style.display == 'none')
    {
        div.style.display = 'block';
        div2.innerHTML = 'ukryj podzadania';
    }
    else
    {
        div.style.display = 'none';
        div2.innerHTML = 'pokaż podzadania';
    }
}

