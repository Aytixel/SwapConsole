<?php
$pdo = new PDO('mysql:dbname=u645156100_swap1;host=mysql.hostinger.fr', 'u645156100_swap1', 'swapconsole1');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);