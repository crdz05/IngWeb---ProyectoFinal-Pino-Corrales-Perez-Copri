<?php
// editar-cancion.php → Controlador para editar una canción

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/SongModel.php';

$pageTitle  = 'Editar Canción - App Musical';
$activePage = 'canciones';

$errors   = [];
$formData = [
    'titulo'   => '',
    'artista'  => '',
    'genero'   => '',
    'ano'      => '',
    'album'    => '',
    'duracion' => '',
];

// 1. Validar ID
if (empty($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: canciones.php');
    exit;
}

$id = (int) $_GET['id'];

// 2. Obtener canción de la BD
$song = getSongById($pdo, $id);

if (!$song) {
    die("La canción con ID $id no existe.");
}

// imagen actual (puede ser null)
$currentImagePath = $song['image_path'] ?? null;

// 3. Rellenar formulario inicial con datos de la canción
$formData['titulo']   = $song['title']    ?? '';
$formData['artista']  = $song['artist']   ?? '';
$formData['genero']   = $song['genre']    ?? '';
$formData['ano']      = $song['year']     ?? '';
$formData['album']    = $song['album']    ?? '';
$formData['duracion'] = $song['duration'] ?? '';

// 4. Procesar POST (si el usuario envía el formulario)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sobrescribir con lo que viene del form
    $formData['titulo']   = trim($_POST['titulo']   ?? '');
    $formData['artista']  = trim($_POST['artista']  ?? '');
    $formData['genero']   = trim($_POST['genero']   ?? '');
    $formData['ano']      = trim($_POST['ano']      ?? '');
    $formData['album']    = trim($_POST['album']    ?? '');
    $formData['duracion'] = trim($_POST['duracion'] ?? '');

    // Validaciones básicas
    if ($formData['titulo'] === '') {
        $errors[] = 'El título de la canción es obligatorio.';
    }

    if ($formData['artista'] === '') {
        $errors[] = 'El artista es obligatorio.';
    }

    if ($formData['ano'] !== '' && !ctype_digit($formData['ano'])) {
        $errors[] = 'El año debe ser un número entero.';
    }

    // Manejo de la imagen (opcional)
    // Por defecto mantenemos la imagen actual
    $imagePath = $currentImagePath;

    if (!empty($_FILES['imagen']['name']) && $_FILES['imagen']['error'] !== UPLOAD_ERR_NO_FILE) {
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/songs/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            if (!in_array($ext, $allowed)) {
                $errors[] = 'Formato de imagen no permitido. Usa JPG, PNG, GIF o WEBP.';
            } else {
                $basename = 'song_' . time() . '_' . mt_rand(1000, 9999) . '.' . $ext;
                $destPath = $uploadDir . $basename;
                $webPath  = 'uploads/songs/' . $basename;

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destPath)) {
                    $imagePath = $webPath;
                } else {
                    $errors[] = 'No se pudo subir la nueva imagen de la canción.';
                }
            }
        } else {
            $errors[] = 'Ocurrió un error al subir la imagen de la canción.';
        }
    }

    // Si no hay errores, actualizar en la BD
    if (empty($errors)) {
        $data = [
            'title'      => $formData['titulo'],
            'artist'     => $formData['artista'],
            'genre'      => $formData['genero'] !== '' ? $formData['genero'] : null,
            'year'       => $formData['ano'] !== '' ? (int)$formData['ano'] : null,
            'album'      => $formData['album'] !== '' ? $formData['album'] : null,
            'duration'   => $formData['duracion'] !== '' ? $formData['duracion'] : null,
            'image_path' => $imagePath,
        ];

        if (updateSong($pdo, $id, $data)) {
            header('Location: canciones.php?msg=editada');
            exit;
        } else {
            $errors[] = 'Ocurrió un error al actualizar la canción en la base de datos.';
        }
    }
}

// 5. Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/editarCancionView.php';
require __DIR__ . '/views/partials/footer.php';
