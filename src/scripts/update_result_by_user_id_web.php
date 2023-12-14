<?php

require dirname(__DIR__, 2) . '/vendor/autoload.php';

use MiW\Results\Entity\Result;
use MiW\Results\Utility\DoctrineConnector;
use MiW\Results\Utility\Utils;

Utils::loadEnv(dirname(__DIR__, 2));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['userId']) ? (int) $_POST['userId'] : 0;
    $newScore = isset($_POST['newResultValue']) ? (int) $_POST['newResultValue'] : 0;

    $entityManager = DoctrineConnector::getEntityManager();

    /** @var Result[] $results */
    $results = $entityManager
        ->getRepository(Result::class)
        ->findBy(['user' => $userId]);

    if (empty($results)) {
        echo "No resultados encontrados para usuario con ID $userId" . PHP_EOL;
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
} else {
    echo "Error";
}
