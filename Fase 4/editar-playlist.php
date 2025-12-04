<?php
// editar-playlist.php → Controlador para editar una playlist

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/PlaylistModel.php';

$pageTitle  = 'Editar Playlist - App Musical';
$activePage = 'playlist';

$errors   = [];
$formData = [
    'nombre'      => '',
    'descripcion' => '',
];

// 1. Validar ID
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: playlist.php');
    exit;
}

$id = (int) $_GET['id'];

// 2. Obtener playlist desde la BD
$playlist = getPlaylistById($pdo, $id);

if (!$playlist) {
    die("La playlist con ID $id no existe.");
}

// Imagen actual (puede ser null)
$currentImagePath = $playlist['image_path'] ?? null;

// 3. Obtener canciones asociadas actualmente a la playlist
$playlistSongIds = getPlaylistSongIds($pdo, $id);

// 4. Obtener todas las canciones disponibles para mostrarlas como opciones
$allSongs = [];
$stmt = $pdo->query("SELECT id, title, artist FROM songs ORDER BY title ASC");
$allSongs = $stmt->fetchAll();

// 5. Rellenar formulario inicial con los datos de la playlist
$formData['nombre']      = $playlist['name']        ?? '';
$formData['descripcion'] = $playlist['description'] ?? '';

// 6. Procesar POST (si el usuario envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Datos del formulario
    $formData['nombre']      = trim($_POST['nombre']      ?? '');
    $formData['descripcion'] = trim($_POST['descripcion'] ?? '');

    // Canciones seleccionadas (checkboxes)
    $selectedSongs = $_POST['songs'] ?? [];
    if (!is_array($selectedSongs)) {
        $selectedSongs = [];
    }

    // Validaciones básicas
    if ($formData['nombre'] === '') {
        $errors[] = 'El nombre de la playlist es obligatorio.';
    }

    // Manejo de imagen (opcional)
    // Por defecto se mantiene la imagen actual
    $imagePath = $currentImagePath;

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
                $webPath  = 'uploads/playlists/' . $basename;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destPath)) {
                    $imagePath = $webPath;
                } else {
                    $errors[] = 'No se pudo subir la nueva imagen de la playlist.';
                }
            }
        } else {
            $errors[] = 'Ocurrió un error al subir la imagen de la playlist.';
        }
    }

    // Si no hay errores, actualizar en la BD
    if (empty($errors)) {
        $data = [
            'name'        => $formData['nombre'],
            'description' => $formData['descripcion'] !== '' ? $formData['descripcion'] : null,
            'image_path'  => $imagePath,
        ];

        if (updatePlaylist($pdo, $id, $data)) {
            // Actualizar canciones asociadas
            syncPlaylistSongs($pdo, $id, $selectedSongs);

            header('Location: playlist.php?msg=editada');
            exit;
        } else {
            $errors[] = 'Ocurrió un error al actualizar la playlist en la base de datos.';
        }
    }

    // Si hubo errores, mantenemos la selección de canciones del POST
    $playlistSongIds = array_map('intval', $selectedSongs);
}

// 7. Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/editarPlaylistView.php';
require __DIR__ . '/views/partials/footer.php';
