<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.html');
    exit();
}

$id = $_GET['id'] ?? '';

$file = 'conseils.csv';
$conseil = [];

if (file_exists($file)) {
    if (($handle = fopen($file, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($data[0] == $id) {
                $conseil = $data;
                break;
            }
        }
        fclose($handle);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $category = htmlspecialchars($_POST['category']);
    $content = htmlspecialchars($_POST['content']);
    $username = $_SESSION['username'];
    $image = htmlspecialchars($_POST['image']);
    $video = htmlspecialchars($_POST['video']);

    $newData = [$title, $category, $content, $username, $image, $video];

    if (($handle = fopen($file, 'r')) !== FALSE) {
        $tempFile = fopen('php://temp', 'r+');
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($data[0] == $id) {
                fputcsv($tempFile, $newData);
            } else {
                fputcsv($tempFile, $data);
            }
        }
        fclose($handle);
        rewind($tempFile);
        $handle = fopen($file, 'w');
        while (($data = fgetcsv($tempFile, 1000, ',')) !== FALSE) {
            fputcsv($handle, $data);
        }
        fclose($handle);
    }

    header('Location: conseils.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le conseil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Modifier le conseil</h1>
    <form action="modifier_conseil.php?id=<?php echo htmlspecialchars($id); ?>" method="post">
        <label for="title">Titre:</label>
        <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($conseil[0]); ?>" required>
        <br>
        <label for="category">Catégorie:</label>
        <input type="text" name="category" id="category" value="<?php echo htmlspecialchars($conseil[1]); ?>" required>
        <br>
        <label for="content">Contenu:</label>
        <textarea name="content" id="content" required><?php echo htmlspecialchars($conseil[2]); ?></textarea>
        <br>
        <label for="image">Image URL:</label>
        <input type="text" name="image" id="image" value="<?php echo htmlspecialchars($conseil[4]); ?>">
        <br>
        <label for="video">Vidéo URL:</label>
        <input type="text" name="video" id="video" value="<?php echo htmlspecialchars($conseil[5]); ?>">
        <br>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>

