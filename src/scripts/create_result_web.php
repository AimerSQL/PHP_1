<?php

/**
 * src/scripts/create_result.php
 *
 * @category Utils
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;
use MiW\Results\Utility\DoctrineConnector;
use MiW\Results\Utility\Utils;

Utils::loadEnv(dirname(__DIR__, 2));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultValue = (int)$_POST['result'];
    $userId = (int)$_POST['userId'];

    $entityManager = DoctrineConnector::getEntityManager();
    $userRepository = $entityManager->getRepository(User::class);
    $user = $userRepository->find($userId);

    if (!$user) {
        echo 'Usuario con ID ' . $userId . ' no encontrado.' . PHP_EOL;
        exit(1);
    }

    $result = new Result($resultValue, $user, new DateTime('now'));

    try {
        $entityManager->persist($result);
        $entityManager->flush();
        echo 'Resulto creado con ID ' . $result->getId() . PHP_EOL;
    } catch (Throwable $exception) {
        echo $exception->getMessage() . PHP_EOL;
    }
} else {
    echo 'Error.' . PHP_EOL;
}
