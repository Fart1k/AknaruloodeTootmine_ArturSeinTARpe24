<?php
include "conf.php"; // lisan conf faili, ühendus andmebaasiga
global $yhendus; // loon globaalne muutuja, selleks, et saaks kasutada seda iga funktsioonides
include "auth.php"; // lisan auth faili, see kontrollib, kas kasutaja on sisse logitud
?>

<link rel="stylesheet" href="style.css">

<?php
include "navigation.php" // lisan navigatsioon
?>

<h2>Lisa uus tellimus</h2>

<form action="?" method="post">
    <label>MustriNr: </label>
    <input type="number" name="mustrinr"><br><br>

    <div class="button">
        <input type="submit" value="Lisa tellimus">
    </div>
</form>

<?php
// tellimuste salvestamine
    if (isset($_POST['mustrinr'])) { // Kontrollin kas vajutati nuppu 'mustrinr'
        $mustrinr = $_REQUEST['mustrinr']; // Salvestan seda $mustrinr muutujasse

        $paring = $yhendus->prepare(
            "INSERT INTO rulood (mustrinr) VALUES (?);"
        );
        $paring->bind_param("i", $mustrinr); // Saadan päringule $id muutuja
        $paring->execute(); // Käivitan päringu

        $uuePakkiId = $yhendus->insert_id; // Salvestab uue objekti ID

        echo "<p>Tellimus on lisatud</p>";
        echo "<p><strong>Sinu tellimuse ID: $uuePakkiId</strong></p>";
    }
?>

<hr>

<h2>Vaata oma paki staatust</h2>

<form action="?" method="post">
    <label>Sinu pakki ID: </label>
    <input type="number" name="pakkiId">
    <div class="button">
        <input type="submit" value="Vaata">
    </div>
</form>

<?php
// tellimuste näitamine
    if (isset($_POST['pakkiId'])) { // Kontrollin kas vajutati nuppu 'pakkiId'
        $pakkiId = $_POST['pakkiId']; // Salvestan seda $pakkiId muutujasse

        $paring = $yhendus->prepare(
            "SELECT * FROM rulood WHERE id=?;"
        );
        $paring->bind_param("i", $pakkiId); // Saadan muutuja päringule
        $paring->execute(); // Käivitan päringu

        $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud); // Salvestan kõik mida päring sai

        if ($paring->fetch()) {
            echo "<table>";
            echo "<tr>
                    <th>ID</th>
                    <th>Muster</th>
                    <th>Riie</th>
                    <th>Puu</th>
                    <th>Pakitud</th>
                  </tr>";
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$mustrinr</td>";
            echo "<td>" . ($riievalmis ? "Valmis" : "Tegemisel") . "</td>";
            echo "<td>" . ($puuvalmis ? "Valmis" : "Tegemisel") . "</td>";
            echo "<td>" . ($pakitud ? "Jah" : "Ei") . "</td>";
            echo "</tr>";
            echo "</table>";
        }
        else {
            echo "<p>Tellimust ei leitud.</p>";
        }
    }
?>