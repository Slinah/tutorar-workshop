<?php
require_once "../includes/functions.php";
session_start();

$idUser = filter_input(INPUT_POST, 'idUser');

$_SESSION['retourUser']=hpost('http://localhost:4567/api/demoteAdmin', array('idPersonne' => $idUser));

header('location: /admin');
