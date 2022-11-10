<?php 
include 'parts/header.php';
?>
    <div class="centrer">
        <h1>Hai già un account?</h1>
        <div class="middler">
            <!-- semplice form -->
            <form action="function/login.php" method="post">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <label>Inserisci l'email</label>
                <input type="text" name="email" placeholder="Email">

                <label>Inserisci la password</label>
                <input type="password" name="password" placeholder="Password">

                <button type="submit">Accedi</button>
            </form>
            <p class="redirect">non hai un profilo? <span><a href="other_pages/registra.php">Registrati</a></span></p>
        </div>
    </div>
</body>

</html>