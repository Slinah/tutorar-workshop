<?php
require_once "../includes/functions.php";
session_start();

$idSchool = filter_input(INPUT_POST, 'idDeleteSchool', FILTER_SANITIZE_SPECIAL_CHARS);

$_SESSION['retourUser']=hpost('http://localhost:4567/api/deleteSchool', array('idSchool' => $idSchool));

header('location: /admin');
