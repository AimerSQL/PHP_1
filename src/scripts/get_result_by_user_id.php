<?php

/**
 * src/get_user_results.php
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

if ($argc != 2) {
    $fich = basename(__FILE__);
    echo <<< MARCA_FIN

    Usage: $fich <UserId>

MARCA_FIN;
    exit(0);
}

$userId = (int) $argv[1];

$entityManager = DoctrineConnector::getEntityManager();

/** @var Result[] $results */
$results = $entityManager
    ->getRepository(Result::class)
    ->findBy(['user' => $userId]);

if (empty($results)) {
    echo "No hay resultados encontrados para usuario con ID $userId" . PHP_EOL;
    exit(0);
}

echo "Resultado para usuario con ID $userId:" . PHP_EOL;

foreach ($results as $result) {
    echo $result . PHP_EOL;
}
