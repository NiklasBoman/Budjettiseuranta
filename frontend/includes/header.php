<div class="header">
    <img src="../frontend/assets/jolly-alarm.gif" alt="logo" class="logo">

    <?php


    if (!isset($_SESSION["userid"])) {
        echo '<a href="../frontend/login.php" class="header-btn">Kirjaudu sisään</a>';
    } else {
        echo '<div style="display: flex; justify-content: space-between;">
                <p style="margin:0px;padding:10px;color: #ffffffff;text-shadow: 0px 0px 7px black;" 
                   class="header-username">
                    Kirjautunut '.$_SESSION["name"].'
                </p>
                <a href="../frontend/logout.php" class="header-btn">Kirjaudu ulos</a>
              </div>';
    }
    ?>
</div>
