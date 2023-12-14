<?php

/**
 * src/update_admin_user.php
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

if (isset($argv[4])) {
    $adminUserId = (int) $argv[1];

    try {
        $adminUser = $entityManager->getRepository(User::class)->find($adminUserId);

        if ($adminUser) {
            $adminUser->setUsername($argv[2]);
            $adminUser->setEmail($argv[3]);
            $adminUser->setPassword($argv[4]);

            $entityManager->flush();

            echo 'Usuario con ID #' . $adminUserId . ' ha sido actualizado.' . PHP_EOL;
        } else {
            echo 'Usuario con ID #' . $adminUserId . ' no encontrado.' . PHP_EOL;
        }
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Proporcione el ID de usuario administrador, el nombre de usuario, el correo electrónico y la contraseña como argumentos de la línea de comando.' . PHP_EOL;
}
