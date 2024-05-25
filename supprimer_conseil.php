<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

$id = $_POST['id'] ?? '';

$file = 'conseils.csv';
$tempFile = 'temp.csv';

if (file_exists($file)) {
    $handle = fopen($file, 'r');
    $tempHandle = fopen($tempFile, 'w');

    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        if ($data[0] != $id) {
            fputcsv($tempHandle, $data);
        }
    }

    fclose($handle);
    fclose($tempHandle);

    rename($tempFile, $file);
}

header('Location: conseils.php');
exit();
?>

