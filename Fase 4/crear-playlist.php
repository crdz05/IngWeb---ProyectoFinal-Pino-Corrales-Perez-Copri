<?php
// crear-playlist.php → Controlador para crear una nueva playlist

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/PlaylistModel.php';

$pageTitle  = 'Crear Playlist - App Musical';
$activePage = 'playlist';

$errors   = [];
$formData = [
    'nombre'      => '',
    'descripcion' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Datos del formulario
    $formData['nombre']      = trim($_POST['nombre']      ?? '');
    $formData['descripcion'] = trim($_POST['descripcion'] ?? '');

    // 2. Validaciones básicas
    if ($formData['nombre'] === '') {
        $errors[] = 'El nombre de la playlist es obligatorio.';
    }

    // 3. Manejo de imagen (opcional)
    $imagePath = null;

    if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/playlists/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {
                $errors[] = 'Formato de imagen no permitido para la playlist. Usa JPG, PNG, GIF o WEBP.';
            } else {
                $basename = 'pl_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
                $destPath = $uploadDir . $basename;
                $webPath  = 'uploads/playlists/' . $basename; // ruta que se guarda en la BD

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destPath)) {
                    $imagePath = $webPath;
                } else {
                    $errors[] = 'No se pudo subir la imagen de la playlist.';
                }
            }
        } else {
            $errors[] = 'Ocurrió un error al subir la imagen de la playlist.';
        }
    }

    // 4. Guardar si no hay errores
    if (empty($errors)) {
        $data = [
            'user_id'     => null,  // en este proyecto no manejamos usuarios reales
            'name'        => $formData['nombre'],
            'description' => $formData['descripcion'] !== '' ? $formData['descripcion'] : null,
            'image_path'  => $imagePath,
        ];

        if (createPlaylist($pdo, $data)) {
            header('Location: playlist.php?msg=creada');
            exit;
        } else {
            $errors[] = 'Ocurrió un error al crear la playlist en la base de datos.';
        }
    }
}

// Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/crearPlaylistView.php';
require __DIR__ . '/views/partials/footer.php';
