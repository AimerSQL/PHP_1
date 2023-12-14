<?php

/**
 * src/create_user_web.php
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
    $newUsername = $_POST['username'] ?? '';
    $newEmail = $_POST['email'] ?? '';
    $newPassword = $_POST['password'] ?? '';

    $user = new User();
    $user->setUsername($newUsername);
    $user->setEmail($newEmail);
    $user->setPassword($newPassword);
    $user->setEnabled(true);
    $user->setIsAdmin(false);

    $entityManager = DoctrineConnector::getEntityManager();

    try {
        $entityManager->persist($user);
        $entityManager->flush();
        echo 'Usuario creado con ID ' . $user->getId() . ' y nombre ' . $newUsername . PHP_EOL;

    } catch (Throwable $exception) {
        echo 'Error.' . PHP_EOL;
    }
}
