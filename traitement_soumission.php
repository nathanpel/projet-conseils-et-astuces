<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = 'conseils.csv';
    $title = htmlspecialchars($_POST['title']);
    $category = htmlspecialchars($_POST['category']);
    $content = htmlspecialchars($_POST['content']);
    $username = $_SESSION['username'];

    $imagePath = '';
    $videoPath = '';

    // Traiter le téléchargement de l'image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $imageTmpPath = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = 'uploads/images/' . $imageName;
        move_uploaded_file($imageTmpPath, $imagePath);
    }

    // Traiter le téléchargement de la vidéo
    if (isset($_FILES['video']) && $_FILES['video']['error'] == UPLOAD_ERR_OK) {
        $videoTmpPath = $_FILES['video']['tmp_name'];
        $videoName = basename($_FILES['video']['name']);
        $videoPath = 'uploads/videos/' . $videoName;
        move_uploaded_file($videoTmpPath, $videoPath);
    }

    $handle = fopen($file, 'a');
    fputcsv($handle, [$title, $category, $content, $username, $imagePath, $videoPath]);
    fclose($handle);

    echo "Conseil soumis avec succès. <a href='conseils.php'>Voir les conseils</a>";
}
?>
