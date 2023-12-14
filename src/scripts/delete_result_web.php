<?php

/**
 * src/scripts/delete_result.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\Result;
use MiW\Results\Utility\DoctrineConnector;
use MiW\Results\Utility\Utils;

Utils::loadEnv(dirname(__DIR__, 2));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultId = (int)$_POST['resultId'];

    $entityManager = DoctrineConnector::getEntityManager();
    $resultRepository = $entityManager->getRepository(Result::class);
    $result = $resultRepository->find($resultId);

    if (!$result) {
        echo 'Resultado con ID ' . $resultId . ' no encontrado.' . PHP_EOL;
        exit(1);
    }

    try {
        $entityManager->remove($result);
        $entityManager->flush();
        echo 'Resultado con ID ' . $resultId . ' ha sido eliminado.' . PHP_EOL;
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Error.' . PHP_EOL;
}
