<?php

/**
 * ./config/cli-config.php
 *
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://miw.etsisi.upm.es E.T.S. de Ingeniería de Sistemas Informáticos
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use MiW\Results\Utility\{ DoctrineConnector, Utils };

// Load env variables from .env + (.docker || .local )
Utils::loadEnv(dirname(__DIR__));

$entityManager = DoctrineConnector::getEntityManager();

$commands = [
    // If you want to add your own custom console commands,
    // you can do so here.
];

ConsoleRunner::run(
    new SingleManagerProvider($entityManager),
    $commands
);
