
<?php
include '../parts/header.php';

$email = ($_GET['email']);
// cryptazione della mail nell'url
$_POST['email'] = crypt($email, '_J9..rasm');
// ricerca di tutti gli eventi che includono la stessa mail dell'utente loggato tramite la sezione attendees
require __DIR__. '/../assets/db/server.php';

$sql = "SELECT nome_evento, data_evento FROM eventi WHERE attendees LIKE '%$email%'";

$retval = mysqli_query($conn, $sql);
// impegni qua ha un utilizzo doppio: tiene gli eventi e allo stesso tempo avvisa nel caso non ce ne siano
$impegni = null;

if (mysqli_num_rows($retval) > 0) {
    $impegni = array();
    while($row = mysqli_fetch_assoc($retval)) {
        array_push($impegni, $row);
    }
} else {
    $impegni = "Non hai nessun meeting in programma";
}

$sql = "SELECT nome, cognome FROM utenti WHERE email = '$email'";
$retval = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($retval);
?>

    <h1>Ciao <?php echo $user["nome"];  ?> <?php echo $user["cognome"];  ?> ecco i tuoi eventi</h1>
    <div class="meetings">
        <?php 
        // semplice if utilizzato per stampare i risultati della ricerca sul database
            if(is_array($impegni)){
                foreach($impegni as $meet){
                    echo 
                        "<div class='middler meet'>
                            <h2>{$meet["nome_evento"]}</h2>
                            <p class='date'>{$meet["data_evento"]}</p>
                            <button>Join</button>
                        </div>";
                }
            } else{
                echo "<h1>Non hai eventi, puoi prenderti la giornata libera.</h1>";
            }

        ?>
    </div>


    
</body>
</html>