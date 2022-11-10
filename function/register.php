<?php 

session_start(); 

require __DIR__. '/../assets/db/server.php';

$db = $conn;

if (!$conn)
{
die ('Could not connect:' . mysql_error());
}

// utilizzo il post per recuperare i valori utilizzati nel form di registrazione

if (isset($_POST['rname'])){ 
    $rname = $_POST['rname']; 
}

if (isset($_POST['cognome'])){ 
    $cognome = $_POST['cognome']; 
}

if (isset($_POST['email'])){ 
    $email = $_POST['email']; 
}

if (isset($_POST['password'])){ 
    $pass = $_POST['password']; 
}

// semplice controllo dell'inserimento di tutti i valori e dell'unicità della mail

if(empty($rname)){

    header("Location: ../other_pages/registra.php?error=Il nome è richiesto");

    exit();

}else if(empty($cognome)){

    header("Location: ../other_pages/registra.php?error=Il cognome è richiesto");

    exit();

}else if (empty($email)) {

    header("Location: ../other_pages/registra.php?error=La mail é richiesta");

    exit();

}else if(empty($pass)){

    header("Location: ../other_pages/registra.php?error=La password é richiesta");

    exit();

} else if(check($email, $conn)){
    header("Location: ../other_pages/registra.php?error=Questa mail è già in utilizzo");

    exit();
}

// funzione artigianale per il controllo dell'unicità

function check($mail, $conn){

    $sql = "SELECT email FROM utenti WHERE email = '$mail'";

    $retval = mysqli_query($conn, $sql);

    if($retval){
        return true;
    } else{
        return false;
    }
}


register($rname,$cognome,$email,$pass);
// funzione utilizzata per registrare i valori inseriti dall'utente nel database
function register($nome,$cognome,$email,$pass){
    global $db;
    $sql="INSERT INTO utenti (nome,cognome,email,password) VALUES ('$nome', '$cognome', '$email', '$pass')";
    $query=$db->prepare($sql);
    $exec= $query->execute();
     if($exec==true)
     {
        header("Location: ../other_pages/user.php?email=$email");
     }
     else
     {
       return "Error: " . $sql . "<br>" .$db->error;
     }
}