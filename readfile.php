<!-- to jest plik testowy -->

<form enctype="multipart/form-data" action="pobierz.php" method="post">
    nazwa pliku<input type="text" name="nazwa" value="test"/>
</form>
<?php
    echo date("Y-m-d_H:i:s");
?>