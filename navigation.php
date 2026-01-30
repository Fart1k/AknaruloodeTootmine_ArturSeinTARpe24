<h1>Aknarulood</h1>

<nav class="menu">
    <ul>
        <?php
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'admin'):
        ?>
            <li>
                <a href="adminTellimused.php">Tellimused</a>
            </li>
            <li>
                <a href="riideosakonnaVaade.php">Riie</a>
            </li>
            <li>
                <a href="puuOsakonnaVaade.php">Puu</a>
            </li>
            <li>
                <a href="komplekteerijateVaade.php">Komplekteerimine</a>
            </li>
        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['user_id'])):
        ?>
            <li>
                <a href="tellimuseLisamine.php">Minu tellimus</a>
            </li>
            <li>
                <a href="logout.php">Logi välja</a>
            </li>
        <?php
        endif;
        ?>
    </ul>
</nav>