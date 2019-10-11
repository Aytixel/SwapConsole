<?php

session_start();
require_once "db.php";

$req = $pdo->query("DELETE FROM member WHERE id = '".$_SESSION['id']."'");