<div class="header">
    <p>logo</p>
    <?php
    // Kirjaudu sisään/ulos painike riippuen siitä, onko käyttäjä kirjautunut vai ei
    session_start();
    if(!isset($_SESSION["userid"])){
        // HUOM! lisätty ../frontend/ polku
        echo '<a href="../frontend/login.php" class="header-btn">Kirjaudu sisään</a>';
    } else {
        echo '<div style="display: flex; justify-content: space-between;">
                <p style="margin:0px;padding:10px;color: #a4ddff;text-shadow: 0px 0px 7px black;" class="header-username">
                    Kirjautunut '.$_SESSION["name"].'
                </p>
                <a href="../frontend/logout.php" class="header-btn">Kirjaudu ulos</a>
              </div>';
    }
    ?>
</div>
