<?php
$serverinimi='localhost';
$kasutajanimi='opilaneArtur';
$parool='12345';
$andmebaasinimi='rulood';
$yhendus=new mysqli($serverinimi, $kasutajanimi, $parool, $andmebaasinimi);
$yhendus->set_charset("utf8");