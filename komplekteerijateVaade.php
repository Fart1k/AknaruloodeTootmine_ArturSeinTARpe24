<?php
include "conf.php";
global $yhendus;
include "auth.php";

if ($_SESSION['roll'] !== 'admin') {
    die("Ligipääs keelatud");
}

/* Riideosa märkimine valmiks */
if (isset($_POST['valmis'])) {
    $id = (int)$_POST['valmis'];

    $paring = $yhendus->prepare(
        "UPDATE rulood SET pakitud = 1 WHERE id = ?"
    );
    $paring->bind_param("i", $id);
    $paring->execute();
}
?>

<link rel="stylesheet" href="style.css">

<?php
include "navigation.php"
?>

<h2>Pakkimata tellimused</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Mustri number</th>
        <th>Riideosa</th>
        <th>Puuvalmis</th>
        <th>Pakitud</th>
        <th>Tegevus</th>
    </tr>

    <?php
    /* Tabeli kuvamine */
    $paring = $yhendus->prepare(
        "SELECT id, mustrinr, riievalmis, puuvalmis, pakitud FROM rulood WHERE riievalmis IS not null and puuvalmis is not null and pakitud is null"
    );

    $paring->execute();
    $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud);

    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($id)."</td>";
        echo "<td>".htmlspecialchars($mustrinr)."</td>";
        echo "<td>Valmis</td>";
        echo "<td>Valmis</td>";
        echo "<td>Ei</td>";
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='valmis' value='$id'>
                        <div class='button'>
                            <button type='submit'>Pakki</button>
                        </div>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
