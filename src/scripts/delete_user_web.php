<?php

/**
 * src/scripts/delete_user.php
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
    if (isset($_POST['userId'])) {
        $userId = (int)$_POST['userId'];

        $entityManager = DoctrineConnector::getEntityManager();
        $userRepository = $entityManager->getRepository(User::class);

        $user = $userRepository->find($userId);

        if ($user) {
            try {
                $entityManager->remove($user);
                $entityManager->flush();
                echo 'Usuario con ID #' . $userId . ' eliminado.';
            } catch (Throwable $exception) {
                echo 'Error en eliminar el usuario: ' . $exception->getMessage();
            }
        } else {
            echo 'Usuario con ID #' . $userId . ' no encontrado.';
        }
    } else {
        echo 'por favor introduzca un ID.';
    }
} else {
    exit;
}
