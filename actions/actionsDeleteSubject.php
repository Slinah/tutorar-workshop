<?php
require_once "../includes/functions.php";

$idDeleteSubject = filter_input(INPUT_POST, 'idDeleteSubject');

//TODO hpost('http://4567/api/deleteSubject', );

hpost('http://localhost:4567/api/deleteSubject', array('idSubject' => $idDeleteSubject));

header('location: /admin');