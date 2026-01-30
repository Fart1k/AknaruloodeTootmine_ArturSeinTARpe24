<?php
include "conf.php";
global $yhendus;

/* Riideosa märkimine valmiks */
if (isset($_GET['valmis'])) {
    $id = (int)$_GET['valmis'];

    $paring = $yhendus->prepare(
        "UPDATE rulood SET riievalmis = 1 WHERE id = ?"
    );
    $paring->bind_param("i", $id);
    $paring->execute();
}
?>

<link rel="stylesheet" href="style.css">

<?php
include "navigation.php"
?>

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
        "SELECT id, mustrinr, riievalmis, puuvalmis, pakitud FROM rulood WHERE riievalmis IS NULL"
    );

    $paring->execute();
    $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud);

    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($id)."</td>";
        echo "<td>".htmlspecialchars($mustrinr)."</td>";
        echo "<td>lõikamata</td>";
        echo "<td>".($puuvalmis ? "Valmis" : "Tegemisel")."</td>";
        echo "<td>".($pakitud ? "Jah" : "Ei")."</td>";
        echo "<td><a href='?valmis=$id'>Valmis</a></td>";
        echo "</tr>";
    }
    ?>
</table>
