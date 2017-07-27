<p>Wyświetl diva:</p>

<p>
    <INPUT TYPE="radio" NAME="nazwa_radio" VALUE="tak" required onClick="document.getElementById('ukryty').style.display='block';" />tak</ br>
    <INPUT TYPE="radio" NAME="nazwa_radio" VALUE="nie" required  onClick="document.getElementById('ukryty').style.display='none';" />nie
</p>

<div style="display: none" id="ukryty">
 <hr />
 <p>Oto treść diva.</p>
 <hr>
</div>