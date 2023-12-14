<?php

/**
 * src/scripts/update_user.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\DoctrineConnector;
use MiW\Results\Utility\Utils;

Utils::loadEnv(dirname(__DIR__, 2));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = (int)$_POST['userId'];
    $newUsername = $_POST['newUsername'] ?? '';
    $newEmail = $_POST['newEmail'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';

    $entityManager = DoctrineConnector::getEntityManager();
    $userRepository = $entityManager->getRepository(User::class);
    $user = $userRepository->find($userId);

    if (!$user) {
        echo 'Usuario con ID ' . $userId . ' no encontrado.' . PHP_EOL;
        exit(1);
    }

    $user->setUsername($newUsername);
    $user->setEmail($newEmail);
    $user->setPassword($newPassword);

    try {
        $entityManager->flush();
        echo 'Usuario actualizado con ID ' . $userId . PHP_EOL;
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Error.' . PHP_EOL;
}

