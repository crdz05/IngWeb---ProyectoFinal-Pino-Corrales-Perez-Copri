<?php
// perfil.php → Perfil de usuario dummy con avatar

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/UserModel.php';

$pageTitle  = 'Mi Perfil - App Musical';
$activePage = 'perfil';

$errors  = [];
$message = '';

// 1. Obtener perfil (id=1)
$userProfile = getUserProfile($pdo);
$currentAvatar = $userProfile['avatar_path'] ?? null;

// 2. Procesar subida de avatar si viene POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/user/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {
                $errors[] = 'Formato de imagen no permitido. Usa JPG, PNG, GIF o WEBP.';
            } else {
                $basename = 'avatar_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
                $destPath = $uploadDir . $basename;
                $webPath  = 'uploads/user/' . $basename;

                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destPath)) {
                    if (updateUserAvatar($pdo, $webPath)) {
                        $currentAvatar = $webPath;
                        $message = 'Avatar actualizado correctamente.';
                    } else {
                        $errors[] = 'No se pudo guardar el avatar en la base de datos.';
                    }
                } else {
                    $errors[] = 'No se pudo subir el archivo de avatar.';
                }
            }
        } else {
            $errors[] = 'Ocurrió un error al subir el avatar.';
        }
    } else {
        $errors[] = 'No seleccionaste ninguna imagen para el avatar.';
    }
}

// 3. Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/perfilView.php';
require __DIR__ . '/views/partials/footer.php';
