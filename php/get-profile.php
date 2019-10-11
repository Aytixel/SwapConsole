<?php

session_start();

$profile = array();

$profile['pseudo'] = $_SESSION['pseudo'];
$profile['email'] = $_SESSION['email'];

echo json_encode($profile);