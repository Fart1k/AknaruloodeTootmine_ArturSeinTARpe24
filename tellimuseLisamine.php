<?php
include "conf.php";
global $yhendus;
?>

<link rel="stylesheet" href="style.css">


<h2>Lisa uus tellimus</h2>

<form action="?" method="post">
    <label>MustriNr: </label>
    <input type="number" name="mustrinr"><br><br>

    <input type="submit" value="Lisa tellimus">
</form>

<?php
// tellimuste salvestamine
    if (isset($_REQUEST['mustrinr'])) {
        $paring = $yhendus->prepare(
            "INSERT INTO rulood (mustrinr) VALUES (?);"
        );
        $paring->bind_param("i", $_REQUEST['mustrinr']);
        $paring->execute();
    }