<?php

session_start();

if ($_SESSION['id'] != null && $_SESSION['pseudo'] != null && $_SESSION['email'] != null && $_SESSION['password'] != null) echo "profile";
else echo "accueil";