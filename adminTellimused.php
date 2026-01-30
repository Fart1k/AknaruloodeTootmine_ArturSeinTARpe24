<?php
include "conf.php"; // lisan conf faili, ühendus andmebaasiga
global $yhendus; // loon globaalne muutuja, selleks, et saaks kasutada seda iga funktsioonides
include "auth.php"; // lisan auth faili, see kontrollib, kas kasutaja on sisse logitud

if ($_SESSION['roll'] !== 'admin') { // kontrollimine, kui kasutaja roll ei ole admin tagastab True
    die("Ligipääs keelatud"); // Keelab liigipääsu aw
}
?>

<link rel="stylesheet" href="style.css">

<?php
include "navigation.php" // lisan navigatsioon
?>

<h2>Kõik tellimused</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Mustri number</th>
        <th>Riideosa</th>
        <th>Puuvalmis</th>
        <th>Pakitud</th>
    </tr>

    <?php
    /* Tabeli kuvamine */
    $paring = $yhendus->prepare(
        "SELECT id, mustrinr, riievalmis, puuvalmis, pakitud FROM rulood" // võtan kõik andmed minu andmebaasist
    );

    $paring->execute(); // käivitan päringu
    $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud); // salvestan kõik mida päring sai

    // Kuvan kogu info tabeli kujul
    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($id)."</td>";
        echo "<td>".htmlspecialchars($mustrinr)."</td>";
        echo "<td>".($riievalmis ? "Valmis" : "Tegemisel")."</td>"; // Kui muutuja ei ole NULL siis True ehk "Valmis"
        echo "<td>".($puuvalmis ? "Valmis" : "Tegemisel")."</td>"; // Kui muutuja ei ole NULL siis True ehk "Valmis"
        echo "<td>".($pakitud ? "Jah" : "Ei")."</td>"; // Kui muutuja ei ole NULL siis True ehk "Jah"
        echo "</tr>";
    }
    ?>
</table>
