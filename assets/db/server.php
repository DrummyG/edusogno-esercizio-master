<!-- file che funziona da server. ricordarsi di modificare la password e il nome del database in caso di cambiamenti. -->

<?php

$sname= "localhost";

$unmae= "root";

$password = "root";

$db_name = "edusogno";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

