<?php

/**
 * src/update_user_score.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\Result;
use MiW\Results\Utility\DoctrineConnector;
use MiW\Results\Utility\Utils;

// Carga las variables de entorno
Utils::loadEnv(dirname(__DIR__, 2));

if ($argc != 3) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId> <NewScore>

MARCA_FIN;
    exit(0);
}

$userId = (int) $argv[1];
$newScore = (int) $argv[2];

$entityManager = DoctrineConnector::getEntityManager();

/** @var Result[] $results */
$results = $entityManager
    ->getRepository(Result::class)
    ->findBy(['user' => $userId]);

if (empty($results)) {
    echo "No results found for user with ID $userId" . PHP_EOL;
    exit(0);
}

try {
    foreach ($results as $result) {
        $result->setScore($newScore);
    }

    $entityManager->flush();

    echo "Usuario con ID $userId ha sido actualizado con el nuevo resultado: $newScore" . PHP_EOL;
} catch (Throwable $exception) {
    echo $exception->getMessage() . PHP_EOL;
}
