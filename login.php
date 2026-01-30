<?php
session_start();
include "conf.php"; // lisan conf faili, ühendus andmebaasiga
global $yhendus; // loon globaalne muutuja, selleks, et saaks kasutada seda iga funktsioonides
?>

<link rel="stylesheet" href="style.css">

<h2>Sisselogimine</h2>

<form method="post" action="?">
    <label>Kasutajanimi:</label><br>
    <input type="text" name="login" required><br><br>

    <label>Parool:</label><br>
    <input type="password" name="pass" required><br><br>

    <div class="button">
        <input type="submit" value="Logi sisse">
    </div>
</form>

<?php
if (!empty($_POST['login']) && !empty($_POST['pass'])) { // Kontroll, kui login ja pass ei ole tühjad, tagastab True

    $login = htmlspecialchars(trim($_POST['login'])); // Salvestab login ilma tühiku
    $pass = hash('sha256', $_POST['pass']); // Salvestab ja krüpteerib parooli

    $paring = $yhendus->prepare(
        "SELECT id, roll FROM kasutajad WHERE kasutajanimi=? AND parool=?"
    );
    $paring->bind_param("ss", $login, $pass); // Saadan need muutujad päringusse ? asemel.
    $paring->execute(); // Käivitan päringu
    $paring->bind_result($id, $roll); // Salvestan kõik mida päring sai

    if ($paring->fetch()) {
        $_SESSION['user_id'] = $id; // Salvestan ID selleks, et mäletada kasutaja sisselogimist
        $_SESSION['roll'] = $roll; // Salvestan kasutaja rolli
        if ($roll == 'admin') {
            header("Location: adminTellimused.php");
            exit();
        }
        if ($roll == 'user') {
            header("Location: tellimuseLisamine.php");
            exit();
        }
        if ($roll == 'puu') {
            header("Location: puuOsakonnaVaade.php");
            exit();
        }
        if ($roll == 'riide') {
            header("Location: riideosakonnaVaade.php");
            exit();
        }
        if ($roll == 'komplekt') {
            header("Location: komplekteerijateVaade.php");
            exit();
        }
    }
    else {
        echo "<p style='text-align:center'>Vale kasutajanimi või parool</p>";
    }
}
?>
