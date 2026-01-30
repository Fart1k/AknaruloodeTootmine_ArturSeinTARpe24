<?php
include "conf.php";
global $yhendus;

/* Riideosa märkimine valmiks */
if (isset($_GET['valmis'])) {
    $id = (int)$_GET['valmis'];

    $paring = $yhendus->prepare(
        "UPDATE rulood SET pakitud = 1 WHERE id = ?"
    );
    $paring->bind_param("i", $id);
    $paring->execute();
}
?>

<link rel="stylesheet" href="style.css">

<h2>Lõikamata riideosaga tellimused</h2>

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
        echo "<td><a href='?valmis=$id'>Pakki</a></td>";
        echo "</tr>";
    }
    ?>
</table>
