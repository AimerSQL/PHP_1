<?php

/**
 * src/delete_admin_user.php
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

$entityManager = DoctrineConnector::getEntityManager();

if (isset($argv[1])) {
    $adminUserId = (int) $argv[1];

    try {
        $adminUser = $entityManager->getRepository(User::class)->find($adminUserId);

        if ($adminUser) {
            $entityManager->remove($adminUser);
            $entityManager->flush();

            echo 'Usuario con ID #' . $adminUserId . ' ha sido eliminado.' . PHP_EOL;
        } else {
            echo 'Usuario con ID #' . $adminUserId . ' no encontrado.' . PHP_EOL;
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Proporcione el ID del usuario como argumento de la línea de comando.' . PHP_EOL;
}
