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
                <a href="riideosakonnaVaade.php">Riideosakonna leht</a>
            </li>
            <li>
                <a href="puuOsakonnaVaade.php">Puuosakonna leht</a>
            </li>
            <li>
                <a href="komplekteerijateVaade.php">Komplekteerijate leht</a>
            </li>
            <li>
                <a href="logout.php">Logi välja</a>
            </li>
        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'puu'):
        ?>
            <li>
                <a href="puuOsakonnaVaade.php">Puuosakonna leht</a>
            </li>
            <li>
                <a href="logout.php">Logi välja</a>
            </li>
        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'riide'):
        ?>
            <li>
                <a href="riideosakonnaVaade.php">Riideosakonna leht</a>
            </li>
            <li>
                <a href="logout.php">Logi välja</a>
            </li>
        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'komplekt'):
        ?>
            <li>
                <a href="komplekteerijateVaade.php">Komplekteerijate leht</a>
            </li>
            <li>
                <a href="logout.php">Logi välja</a>
            </li>
        <?php
        endif;
        ?>

        <?php
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'user'):
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