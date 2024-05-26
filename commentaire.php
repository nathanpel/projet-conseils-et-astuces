<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conseilId = $_POST['conseil_id'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    if (!empty($comment)) {
        $file = 'commentaires.csv';
        $handle = fopen($file, 'a');
        fputcsv($handle, [$conseilId, $comment, $username]);
        fclose($handle);
    }
}

header('Location: conseils.php');
exit();
?>
