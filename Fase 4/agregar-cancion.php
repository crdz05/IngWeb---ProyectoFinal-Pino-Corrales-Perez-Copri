<?php
// agregar-cancion.php → Controlador para agregar nuevas canciones

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/SongModel.php';

$pageTitle  = 'Agregar Canción - App Musical';
$activePage = 'canciones';

$errors  = [];
$oldData = [
    'titulo'   => '',
    'artista'  => '',
    'genero'   => '',
    'ano'      => '',
    'album'    => '',
    'duracion' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Recibir datos del formulario
    $oldData['titulo']   = trim($_POST['titulo']   ?? '');
    $oldData['artista']  = trim($_POST['artista']  ?? '');
    $oldData['genero']   = trim($_POST['genero']   ?? '');
    $oldData['ano']      = trim($_POST['ano']      ?? '');
    $oldData['album']    = trim($_POST['album']    ?? '');
    $oldData['duracion'] = trim($_POST['duracion'] ?? '');

    // 2. Validaciones básicas
    if ($oldData['titulo'] === '') {
        $errors[] = 'El título de la canción es obligatorio.';
    }

    if ($oldData['artista'] === '') {
        $errors[] = 'El artista es obligatorio.';
    }

    if ($oldData['ano'] !== '' && !ctype_digit($oldData['ano'])) {
        $errors[] = 'El año debe ser un número entero.';
    }

    // 3. Manejo de la imagen (opcional)
    $imagePath = null;

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
                $webPath  = 'uploads/songs/' . $basename; // ruta que se guarda en la BD

                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $destPath)) {
                    $imagePath = $webPath;
                } else {
                    $errors[] = 'No se pudo subir la imagen de la canción.';
                }
            }
        } else {
            $errors[] = 'Ocurrió un error al subir la imagen de la canción.';
        }
    }

    // 4. Si no hay errores, guardar en la BD
    if (empty($errors)) {
        $data = [
            'title'      => $oldData['titulo'],
            'artist'     => $oldData['artista'],
            'genre'      => $oldData['genero'] !== '' ? $oldData['genero'] : null,
            'year'       => $oldData['ano'] !== '' ? (int)$oldData['ano'] : null,
            'album'      => $oldData['album'] !== '' ? $oldData['album'] : null,
            'duration'   => $oldData['duracion'] !== '' ? $oldData['duracion'] : null,
            'image_path' => $imagePath,
        ];

        if (createSong($pdo, $data)) {
            header('Location: canciones.php?msg=agregada');
            exit;
        } else {
            $errors[] = 'Ocurrió un error al guardar la canción en la base de datos.';
        }
    }
}

// Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/agregarCancionView.php';
require __DIR__ . '/views/partials/footer.php';
