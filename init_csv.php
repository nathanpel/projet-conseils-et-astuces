<?php
// Chemin vers les fichiers CSV
$usersFile = 'users.csv';
$conseilsFile = 'conseils.csv';

// Vérifier si les fichiers existent
if (!file_exists($usersFile)) {
    // Créer le fichier users.csv avec les en-têtes
    $handle = fopen($usersFile, 'w');
    fputcsv($handle, ['username', 'email', 'password']);
    fclose($handle);
    echo "Fichier users.csv créé avec succès.<br>";
} else {
    echo "Fichier users.csv existe déjà.<br>";
}

if (!file_exists($conseilsFile)) {
    // Créer le fichier conseils.csv avec les en-têtes
    $handle = fopen($conseilsFile, 'w');
    fputcsv($handle, ['title', 'category', 'content', 'username']);
    fclose($handle);
    echo "Fichier conseils.csv créé avec succès.<br>";
} else {
    echo "Fichier conseils.csv existe déjà.<br>";
}
?>
