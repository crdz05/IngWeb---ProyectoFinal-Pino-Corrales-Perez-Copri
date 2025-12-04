<?php
// playlist.php → Controlador para "Mis Playlists"

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/PlaylistModel.php';

$pageTitle  = 'Mis Playlists - App Musical';
$activePage = 'playlist';

$message = '';

// Eliminar playlist si viene ?eliminar=ID
if (isset($_GET['eliminar']) && ctype_digit($_GET['eliminar'])) {
    $id = (int) $_GET['eliminar'];

    if ($id > 0) {
        if (deletePlaylist($pdo, $id)) {
            header('Location: playlist.php?msg=eliminada');
            exit;
        } else {
            $message = 'No se pudo eliminar la playlist. Intente nuevamente.';
        }
    }
}

// Mensaje opcional por acciones anteriores
if (isset($_GET['msg'])) {
    if ($_GET['msg'] === 'creada') {
        $message = 'Playlist creada correctamente.';
    } elseif ($_GET['msg'] === 'editada') {
        $message = 'Playlist actualizada correctamente.';
    } elseif ($_GET['msg'] === 'eliminada') {
        $message = 'Playlist eliminada correctamente.';
    }
}

// Obtener playlists desde el modelo
$playlists = getPlaylists($pdo);

// Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/playlistView.php';
require __DIR__ . '/views/partials/footer.php';
