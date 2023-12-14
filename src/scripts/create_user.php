<?php

/**
 * src/create_user.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Utility\DoctrineConnector;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

if ($argc != 4) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <Username> <Email> <Password>

MARCA_FIN;
    exit(0);
}

$newUsername = $argv[1];
$newEmail = $argv[2];
$newPassword = $argv[3];

$entityManager = DoctrineConnector::getEntityManager();

$user = new User();
$user->setUsername($newUsername);
$user->setEmail($newEmail);
$user->setPassword($newPassword);
$user->setEnabled(true);
$user->setIsAdmin(false);

try {
    $entityManager->persist($user);
    $entityManager->flush();
    echo 'Usuario creado con ID ' . $user->getId() . ' y nombre ' . $newUsername . PHP_EOL;
} catch (Throwable $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
