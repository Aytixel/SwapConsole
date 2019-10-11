<?php

session_start();

$contacts;

if ($_SESSION['contacts'] == null) $contacts = "[]";
else $contacts = $_SESSION['contacts'];

echo $contacts;