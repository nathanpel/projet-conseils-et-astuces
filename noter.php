<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conseilId = $_POST['conseil_id'];
    $rating = $_POST['rating'];
    $username = $_SESSION['username'];

    if (!empty($rating) && is_numeric($rating) && $rating >= 1 && $rating <= 5) {
        $file = 'notes.csv';
        $handle = fopen($file, 'a');
        fputcsv($handle, [$conseilId, $rating, $username]);
        fclose($handle);
    }
}

header('Location: conseils.php');
exit();
?>
