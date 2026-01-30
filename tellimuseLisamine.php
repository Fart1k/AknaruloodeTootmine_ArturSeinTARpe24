<?php
include "conf.php";
global $yhendus;
?>

<link rel="stylesheet" href="style.css">
<?php
include "navigation.php"
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
    if (isset($_POST['mustrinr'])) {
        $mustrinr = (int)$_REQUEST['mustrinr'];

        $paring = $yhendus->prepare(
            "INSERT INTO rulood (mustrinr) VALUES (?);"
        );
        $paring->bind_param("i", $mustrinr);
        $paring->execute();

        $uuePakkiId = $yhendus->insert_id;

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
    if (isset($_POST['pakkiId'])) {
        $pakkiId = (int)$_POST['pakkiId'];

        $paring = $yhendus->prepare(
            "SELECT * FROM rulood WHERE id=?;"
        );
        $paring->bind_param("i", $pakkiId);
        $paring->execute();

        $paring->bind_result($id, $mustrinr, $riievalmis, $puuvalmis, $pakitud);

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
        } else {
            echo "<p>Tellimust ei leitud.</p>";
        }
    }
?>