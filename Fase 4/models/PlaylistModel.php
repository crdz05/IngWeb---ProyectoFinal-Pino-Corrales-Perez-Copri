<?php
// models/PlaylistModel.php

/**
 * Obtiene todas las playlists con el conteo de canciones.
 */
function getPlaylists(PDO $pdo): array
{
    $sql = "
        SELECT 
            p.id,
            p.name,
            p.description,
            p.image_path,
            p.created_at,
            COUNT(ps.song_id) AS song_count
        FROM playlists p
        LEFT JOIN playlist_song ps ON p.id = ps.playlist_id
        GROUP BY p.id, p.name, p.description, p.image_path, p.created_at
        ORDER BY p.id DESC
    ";

    $stmt = $pdo->query($sql);
    return $stmt->fetchAll();
}

/**
 * Elimina una playlist por ID.
 * (Las relaciones en playlist_song se borran por la FK ON DELETE CASCADE)
 */
function deletePlaylist(PDO $pdo, int $id): bool
{
    $stmt = $pdo->prepare("DELETE FROM playlists WHERE id = :id");
    return $stmt->execute([':id' => $id]);
}

/**
 * Crea una nueva playlist.
 *
 * $data = [
 *   'user_id'     => int|null,
 *   'name'        => string,
 *   'description' => string|null,
 *   'image_path'  => string|null
 * ]
 */
function createPlaylist(PDO $pdo, array $data): bool
{
    $sql = "INSERT INTO playlists (user_id, name, description, image_path)
            VALUES (:user_id, :name, :description, :image_path)";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':user_id'     => $data['user_id']    ?? null,
        ':name'        => $data['name'],
        ':description' => $data['description'] ?? null,
        ':image_path'  => $data['image_path'] ?? null,
    ]);
}

/**
 * Obtiene una playlist por ID.
 */
function getPlaylistById(PDO $pdo, int $id): ?array
{
    $stmt = $pdo->prepare("SELECT * FROM playlists WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $row = $stmt->fetch();

    return $row ?: null;
}

/**
 * Actualiza una playlist existente.
 *
 * $data = [
 *   'name'        => string,
 *   'description' => string|null,
 *   'image_path'  => string|null
 * ]
 */
function updatePlaylist(PDO $pdo, int $id, array $data): bool
{
    $sql = "UPDATE playlists
            SET name        = :name,
                description = :description,
                image_path  = :image_path
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);

    return $stmt->execute([
        ':name'        => $data['name'],
        ':description' => $data['description'] ?? null,
        ':image_path'  => $data['image_path'] ?? null,
        ':id'          => $id,
    ]);
}

/**
 * Devuelve los IDs de canciones asociadas a una playlist (para checkboxes).
 */
function getPlaylistSongIds(PDO $pdo, int $playlistId): array
{
    $stmt = $pdo->prepare("SELECT song_id FROM playlist_song WHERE playlist_id = :id");
    $stmt->execute([':id' => $playlistId]);

    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

/**
 * Sincroniza las canciones de una playlist:
 * borra las actuales y agrega las nuevas (si se usan checkboxes).
 *
 * @param int   $playlistId
 * @param int[] $songIds
 */
function syncPlaylistSongs(PDO $pdo, int $playlistId, array $songIds): bool
{
    // Borrar relaciones actuales
    $stmt = $pdo->prepare("DELETE FROM playlist_song WHERE playlist_id = :id");
    $stmt->execute([':id' => $playlistId]);

    // Insertar nuevas
    if (empty($songIds)) {
        return true;
    }

    $stmt = $pdo->prepare("INSERT INTO playlist_song (playlist_id, song_id) VALUES (:playlist_id, :song_id)");

    foreach ($songIds as $songId) {
        if (!ctype_digit((string)$songId)) {
            continue;
        }
        $stmt->execute([
            ':playlist_id' => $playlistId,
            ':song_id'     => (int)$songId,
        ]);
    }

    return true;
}

