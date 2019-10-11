<?php

session_start();
require_once('db.php');

$id = (int) $_POST['id'];

$req = $pdo->query("SELECT * FROM tchat WHERE id > ".$id." ORDER BY id DESC");

$messages;

while($donnees = $req->fetch()){
    if ($donnees->des== $_SESSION['pseudo']) $messages .= '<div class="tchat-message" id="'.$donnees->id.'"><div class="pseudo">'.$donnees->pseudo.' : </div>'.$donnees->message.'</div><br/>';
    else if ($donnees->pseudo == $_SESSION['pseudo']) $messages .= '<div class="tchat-message" id="'.$donnees->id.'"><div class="pseudo">Moi : </div>'.$donnees->message.'</div><br/>';
}

echo $messages;
