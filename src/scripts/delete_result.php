<?php

/**
 * src/delete_result.php
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

$entityManager = DoctrineConnector::getEntityManager();

if (isset($argv[1])) {
    $resultId = (int) $argv[1];

    try {
        $result = $entityManager->getRepository(Result::class)->find($resultId);

        if ($result) {
            $entityManager->remove($result);
            $entityManager->flush();

            echo 'Resultado con ID #' . $resultId . ' ha sido eliminado.' . PHP_EOL;
        } else {
            echo 'Resultado con ID #' . $resultId . ' no encontrado.' . PHP_EOL;
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Proporcione el ID del resultado como argumento de la línea de comando.' . PHP_EOL;
}
