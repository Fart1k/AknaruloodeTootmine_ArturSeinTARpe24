<?php
include "conf.php"; // lisan conf faili, ühendus andmebaasiga
global $yhendus; // loon globaalne muutuja, selleks, et saaks kasutada seda iga funktsioonides
include "auth.php"; // lisan auth faili, see kontrollib, kas kasutaja on sisse logitud


/* Puuosa märkimine valmiks */
if (isset($_POST['valmis'])) { // Kontrollin kas vajutati nuppu 'valmis'
    $id = $_POST['valmis']; // Salvestan seda $id muutujasse

    $paring = $yhendus->prepare(
        "UPDATE rulood SET puuvalmis = 1 WHERE id = ?"
    );
    $paring->bind_param("i", $id); // Saadan päringule $id muutuja
    $paring->execute(); // Käivitan päringu
}
?>

<link rel="stylesheet" href="style.css">

<?php
include "navigation.php" // lisan navigatsioon
?>

<h2>Lõikamata puudeosadega tellimused</h2>

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
        "SELECT id, mustrinr, riievalmis, puuvalmis, pakitud FROM rulood WHERE puuvalmis IS NULL"
    );

    $paring->execute(); // Käivitan päringu
    $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud); // salvestan kõik mida päring sai

    // Kuvan kogu info tabeli kujul
    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($id)."</td>";
        echo "<td>".htmlspecialchars($mustrinr)."</td>";
        echo "<td>".($riievalmis ? "Valmis" : "Tegemisel")."</td>";
        echo "<td>Tegemisel</td>";
        echo "<td>".($pakitud ? "Jah" : "Ei")."</td>";
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='valmis' value='$id'>
                        <div class='button'>
                            <button type='submit'>Valmis</button>
                        </div>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
