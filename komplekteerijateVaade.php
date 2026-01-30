<?php
include "conf.php"; // lisan conf faili, ühendus andmebaasiga
global $yhendus; // loon globaalne muutuja, selleks, et saaks kasutada seda iga funktsioonides
include "auth.php"; // lisan auth faili, see kontrollib, kas kasutaja on sisse logitud


/* Pakkituks märkimine */
if (isset($_POST['pakki'])) { // Kontrollin kas vajutati nuppu 'pakki'
    $id = $_POST['pakki']; // Salvestan seda $id muutujasse

    $paring = $yhendus->prepare(
        "UPDATE rulood SET pakitud = 1 WHERE id = ?"
    );
    $paring->bind_param("i", $id); // Saadan päringule $id muutuja
    $paring->execute(); // käivitan päringu
}
?>

<link rel="stylesheet" href="style.css">

<?php
include "navigation.php" // lisan navigatsioon
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

    $paring->execute(); // Käivitan päringu
    $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud); // salvestan kõik mida päring sai


    // Kuvan kogu info tabeli kujul
    while ($paring->fetch()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($id)."</td>";
        echo "<td>".htmlspecialchars($mustrinr)."</td>";
        echo "<td>Valmis</td>";
        echo "<td>Valmis</td>";
        echo "<td>Ei</td>";
        echo "<td>
                <form method='post'>
                    <input type='hidden' name='pakki' value='$id'>
                        <div class='button'>
                            <button type='submit'>Pakki</button>
                        </div>
                </form>
              </td>";
        echo "</tr>";
    }
    ?>
</table>
