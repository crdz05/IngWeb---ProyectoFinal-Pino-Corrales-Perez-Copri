<?php
// index.php → Página de inicio (dashboard)

require __DIR__ . '/config/db.php';
require __DIR__ . '/models/SongModel.php';
require __DIR__ . '/models/PlaylistModel.php';

$pageTitle  = 'Inicio - App Musical';
$activePage = 'inicio';

// 1. Canciones recientes (para la sección de abajo y para el card de "Canciones")
$recentSongs = getRecentSongs($pdo, 3); // máximo 3

// Primera canción (para la imagen grande de "Canciones")
$firstSong = $recentSongs[0] ?? null;

// 2. Playlists (para el card de "Playlist")
$playlists = getPlaylists($pdo);
$firstPlaylist = $playlists[0] ?? null;

// Cargar vistas
require __DIR__ . '/views/partials/header.php';
require __DIR__ . '/views/indexView.php';
require __DIR__ . '/views/partials/footer.php';
