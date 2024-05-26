<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conseil_id = $_POST['conseil_id'];
    $rating = $_POST['rating'];
    $username = $_SESSION['username'];

    $file = 'notes.csv';
    $handle = fopen($file, 'a');
    fputcsv($handle, [$conseil_id, $rating, $username]);
    fclose($handle);

    header('Location: conseils.php');
    exit();
}
?>
