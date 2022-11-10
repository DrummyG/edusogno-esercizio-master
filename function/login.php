<?php 

session_start(); 

require __DIR__. '/../assets/db/server.php';

// semplice controllo del ricevimento dei dati
if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    // controllo che i valori di email e password non siano vuoti

    if (empty($email)) {

        header("Location: ../index.php?error=Email is required");

        exit();

    }else if(empty($pass)){

        header("Location: ../index.php?error=Password is required");

        exit();

    }else{
        // recupero i dati con la stessa mail e password dal database

        $sql = "SELECT * FROM utenti WHERE email='$email' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        // controllo che vi sia un solo risultato

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            // controllo che password ed email del singolo risultato coincidano con quelle emesse dall'utente

            if ($row['email'] === $email && $row['password'] === $pass) {

                header("Location: ../other_pages/user.php?email=$email");

                $_SESSION['id'] = $row['id'];

                exit();

            }else{

                header("Location: ../index.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: ../index.php?error=Incorect User name or password");

            exit();

        }

    }

}else{

    header("Location: ../index.php");

    exit();

}