<?php
// canciones.php → Controlador de la página "Ver Canciones"

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/SongModel.php';

$pageTitle  = 'Ver Canciones - App Musical';
$activePage = 'canciones';

// --- Eliminar canción (si viene ?eliminar=ID en la URL) ---
if (isset($_GET['eliminar']) && ctype_digit($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];

    if ($id > 0) {
        deleteSong($pdo, $id);
        header('Location: canciones.php?msg=eliminada');
        exit;
    }
}

// --- Filtros recibidos por GET ---
$search = trim($_GET['buscar']  ?? '');
$genre  = $_GET['genero']       ?? 'Todos';
$artist = $_GET['artista']      ?? 'Todos';
$year   = $_GET['ano']          ?? 'Todos';

// Array de filtros para el modelo
$filters = [
    'search' => $search,
    'genre'  => $genre,
    'artist' => $artist,
    'year'   => $year,
];

// Obtenemos las canciones desde el modelo
$canciones = getSongs($pdo, $filters);

// Listas para los combos de Artista y Año
$artistsList = getDistinctArtists($pdo);
$yearsList   = getDistinctYears($pdo);

// Mensaje opcional (ej: después de eliminar o agregar/editar)
$message = '';
if (!empty($_GET['msg'])) {
    switch ($_GET['msg']) {
        case 'eliminada':
            $message = 'Canción eliminada correctamente.';
            break;
        case 'agregada':
            $message = 'Canción agregada correctamente.';
            break;
        case 'editada':
            $message = 'Canción actualizada correctamente.';
            break;
    }
}

// Cargamos vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/cancionesView.php';
require __DIR__ . '/views/partials/footer.php';
