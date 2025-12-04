<?php
// models/UserModel.php

/**
 * Devuelve el perfil del usuario dummy (id 1).
 * Si no existe, intenta crearlo vacío.
 */
function getUserProfile(PDO $pdo): array
{
    $stmt = $pdo->prepare("SELECT * FROM user_profile WHERE id = 1");
    $stmt->execute();
    $row = $stmt->fetch();

    if (!$row) {
        $pdo->exec("INSERT INTO user_profile (id, avatar_path) VALUES (1, NULL)");
        $stmt = $pdo->prepare("SELECT * FROM user_profile WHERE id = 1");
        $stmt->execute();
        $row = $stmt->fetch();
    }

    return $row ?: ['id' => 1, 'avatar_path' => null];
}

/**
 * Actualiza solo el avatar del usuario dummy.
 */
function updateUserAvatar(PDO $pdo, string $avatarPath): bool
{
    $stmt = $pdo->prepare("UPDATE user_profile SET avatar_path = :avatar WHERE id = 1");
    return $stmt->execute([':avatar' => $avatarPath]);
}
