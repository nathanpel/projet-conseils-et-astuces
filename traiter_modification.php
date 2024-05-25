<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $original_title = $_POST['original_title'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];
    $username = $_SESSION['username'];

    $file = 'conseils.csv';
    $tempFile = 'temp.csv';

    $handle = fopen($file, 'r');
    $tempHandle = fopen($tempFile, 'w');

    while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
        if ($data[0] == $original_title && $data[3] == $username) {
            $data[0] = $title;
            $data[1] = $category;
            $data[2] = $content;
        }
        fputcsv($tempHandle, $data);
    }

    fclose($handle);
    fclose($tempHandle);

    rename($tempFile, $file);

    header('Location: conseils.php');
    exit();
}
