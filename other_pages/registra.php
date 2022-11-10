<?php 
include '../parts/header.php';
    // setto a null i valori iniziali del form in modo tale da non ricevere nessun errore aprendo la pagina per la prima volta
    $rname = null;
    $cognome = null;
    $email = null;
    $pass = null;
?>
    <div class="centrer">
    <h1>Crea il tuo account</h1>
    <!-- semplice form -->
        <div class="middler">
            <form action="../function/register.php" method="post">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <label>Inserisci il nome</label>
                <input type="text" name="rname" placeholder="Nome" value='<?php echo "$rname"; ?>'><br>

                <label>Inserisci il cognome</label>
                <input type="text" name="cognome" placeholder="Cognome" value='<?php echo "$cognome"; ?>'><br>

                <label>Inserisci l'email</label>
                <input type="text" name="email" placeholder="Email" value='<?php echo "$email"; ?>'><br>

                <label>Inserisci la password</label>
                <input type="password" name="password" placeholder="Password" value='<?php echo "$pass"; ?>'><br> 

                <button type="submit">Registrati</button>
            </form>

            <p class="redirect">hai già un profilo? <span><a href="../index.php">Accedi</a></span></p>
        </div>
    </div>
</body>

</html>