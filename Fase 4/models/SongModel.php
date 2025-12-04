<?php
// models/SongModel.php

/**
 * Devuelve las canciones más recientes para el inicio.
 */
function getRecentSongs(PDO $pdo, int $limit = 3): array
{
    $sql = "SELECT id, title, artist, genre, year, image_path
            FROM songs
            ORDER BY created_at DESC
            LIMIT :limit";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll();
}

/**
 * Lista canciones con filtros opcionales (buscar, género, artista, año).
 *
 * $filters = [
 *   'search' => 'texto a buscar en título o artista',
 *   'genre'  => 'Rock' | 'Pop' | 'Todos' | '',
 *   'artist' => 'nombre artista' | 'Todos' | '',
 *   'year'   => '2024' | '2023' | 'Todos' | ''
 * ]
 */
function getSongs(PDO $pdo, array $filters = []): array
{
    $where  = [];
    $params = [];

    $search = trim($filters['search'] ?? '');
    $genre  = trim($filters['genre']  ?? '');
    $artist = trim($filters['artist'] ?? '');
    $year   = trim($filters['year']   ?? '');

    if ($search !== '') {
        $where[] = "(title LIKE :search OR artist LIKE :search)";
        $params[':search'] = '%' . $search . '%';
    }

    if ($genre !== '' && $genre !== 'Todos') {
        $where[] = "genre = :genre";
        $params[':genre'] = $genre;
    }

    if ($artist !== '' && $artist !== 'Todos') {
        $where[] = "artist = :artist";
        $params[':artist'] = $artist;
    }

    if ($year !== '' && $year !== 'Todos') {
        $where[] = "year = :year";
        $params[':year'] = (int)$year;
    }

    $sql = "SELECT id, title, artist, genre, year, image_path
            FROM songs";

    if ($where) {
        $sql .= " WHERE " . implode(' AND ', $where);
    }

    $sql .= " ORDER BY id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll();
}

/**
 * Elimina una canción por ID.
 */
function deleteSong(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare("DELETE FROM songs WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

/**
 * Crea una nueva canción en la base de datos.
 */
function createSong(PDO $pdo, array $data): bool
{
    $sql = "INSERT INTO songs (title, artist, genre, year, album, duration, image_path)
            VALUES (:title, :artist, :genre, :year, :album, :duration, :image_path)";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':title'      => $data['title'],
        ':artist'     => $data['artist'],
        ':genre'      => $data['genre']    ?? null,
        ':year'       => $data['year']     ?? null,
        ':album'      => $data['album']    ?? null,
        ':duration'   => $data['duration'] ?? null,
        ':image_path' => $data['image_path'] ?? null,
    ]);
}

/**
 * Obtiene una canción por ID.
 */
function getSongById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare("SELECT * FROM songs WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $song = $stmt->fetch();

    return $song ?: null;
}

/**
 * Actualiza una canción existente.
 */
function updateSong(PDO $pdo, int $id, array $data): bool
{
    $sql = "UPDATE songs
            SET title      = :title,
                artist     = :artist,
                genre      = :genre,
                year       = :year,
                album      = :album,
                duration   = :duration,
                image_path = :image_path
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':title'      => $data['title'],
        ':artist'     => $data['artist'],
        ':genre'      => $data['genre']    ?? null,
        ':year'       => $data['year']     ?? null,
        ':album'      => $data['album']    ?? null,
        ':duration'   => $data['duration'] ?? null,
        ':image_path' => $data['image_path'] ?? null,
        ':id'         => $id,
    ]);
}

/**
 * Devuelve lista de artistas distintos (para el combo de filtros).
 */
function getDistinctArtists(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT DISTINCT artist FROM songs WHERE artist IS NOT NULL AND artist <> '' ORDER BY artist ASC");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/**
 * Devuelve lista de años distintos (para el combo de filtros).
 */
function getDistinctYears(PDO $pdo): array
{
    $stmt = $pdo->query("SELECT DISTINCT year FROM songs WHERE year IS NOT NULL ORDER BY year DESC");
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}
