<?php
require_once "../includes/functions.php";
session_start();


$idPersonne = filter_input(INPUT_POST, 'id_personne', FILTER_SANITIZE_SPECIAL_CHARS);
$idMatiere = filter_input(INPUT_POST, 'id_matiere', FILTER_SANITIZE_SPECIAL_CHARS);
$idPromo = filter_input(INPUT_POST, "id_promo", FILTER_SANITIZE_SPECIAL_CHARS);
$intitule = filter_input(INPUT_POST, "intitule", FILTER_SANITIZE_SPECIAL_CHARS);
$commentaires = filter_input(INPUT_POST, "commentaires", FILTER_SANITIZE_SPECIAL_CHARS);


$date = filter_input(INPUT_POST, "date", FILTER_SANITIZE_SPECIAL_CHARS);
$heure = filter_input(INPUT_POST, "dateHeure", FILTER_SANITIZE_SPECIAL_CHARS);


$heure .= ":00";
$timeZone = new DateTimeZone("Europe/Paris");
$format = 'Y-m-d H:i:s';
$d = DateTime::createFromFormat($format, $date . ' ' . $heure, $timeZone);
var_dump($d);

if ($d != null) {
    $d = $d->format('Y-m-d H:i:s');
    $_SESSION['retourUser'] = hpost("http://localhost:4567/api/postCourse", array("id_personne" => $idPersonne, "id_matiere" => $idMatiere, "id_promo" => $idPromo, "intitule" => $intitule,
        "date" => $d, "commentaires" => $commentaires));
}
var_dump($_SESSION);


header("Location: /cours#inSemaine");
