<h1>Aknarulood</h1>

<nav class="menu">
    <ul>
        <?php
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'admin'): // Kui roll on olemas ja see on admin, tagastab True
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
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'puu'): // Kui roll on olemas ja see on puu, tagastab True
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
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'riide'): // Kui roll on olemas ja see on riide, tagastab True
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
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'komplekt'): // Kui roll on olemas ja see on komplekt, tagastab True
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
        if (isset($_SESSION['roll']) && $_SESSION['roll'] == 'user'): // Kui roll on olemas ja see on user, tagastab True
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