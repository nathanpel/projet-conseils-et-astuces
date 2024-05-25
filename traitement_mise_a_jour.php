<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['username'])) {
    $file = 'users.csv';
    $old_username = $_SESSION['username'];
    $new_username = htmlspecialchars($_POST['username']);
    $new_email = htmlspecialchars($_POST['email']);
    $new_password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : '';

    $rows = [];
    $user_found = false;

    if (($handle = fopen($file, 'r')) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {
            if ($data[0] == $old_username) {
                $user_found = true;
                if ($new_password) {
                    $data = [$new_username, $new_email, $new_password];
                } else {
                    $data = [$new_username, $new_email, $data[2]];
                }
                $_SESSION['username'] = $new_username;
            }
            $rows[] = $data;
        }
        fclose($handle);
    }

    if ($user_found) {
        $handle = fopen($file, 'w');
        foreach ($rows as $row) {
            fputcsv($handle, $row);
        }
        fclose($handle);
        header('Location: profil.php');
        exit();
    } else {
        echo "Utilisateur non trouvé.";
    }
}
?>
