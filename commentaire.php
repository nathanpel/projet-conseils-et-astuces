<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conseil_id = $_POST['conseil_id'];
    $comment = $_POST['comment'];
    $username = $_SESSION['username'];

    $file = 'commentaires.csv';
    $handle = fopen($file, 'a');
    fputcsv($handle, [$conseil_id, $comment, $username]);
    fclose($handle);

    header('Location: conseils.php');
    exit();
}
?>
