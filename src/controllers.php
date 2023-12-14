<?php

/**
 * ResultsDoctrine - controllers.php
 *
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://www.etsisi.upm.es/ ETS de Ingeniería de Sistemas Informáticos
 */

use MiW\Results\Entity\User;
use MiW\Results\Entity\Result;
use MiW\Results\Utility\DoctrineConnector;

function funcionHomePage(): void
{
    global $routes;

    $rutaListado = $routes->get('ruta_user_list')->getPath();
    $rutaListadoResultado = $routes->get('ruta_result_list')->getPath();
    $rutaCrearUsuario = $routes->get('ruta_create_user')->getPath();
    $rutaEliminarUsuario = $routes->get('ruta_delete_user')->getPath();
    $rutaCrearResultado = $routes->get('ruta_create_result')->getPath();
    $rutaEliminarResultado = $routes->get('ruta_delete_result')->getPath();
    $rutaActualizarUsuario = $routes->get('ruta_update_user')->getPath();
    $rutaActualizarResultado = $routes->get('ruta_update_result')->getPath();
    echo <<< MARCA_FIN
    <ul>
        <li><a href="$rutaListado">Listado Usuarios</a></li>
    </ul>
    <ul>
        <li><a href="$rutaListadoResultado">Listado Resultados</a></li>
    </ul>
    <ul>
        <li><a href="$rutaCrearUsuario">Crear Usuario</a></li>
    </ul>
    <ul>
        <li><a href="$rutaEliminarUsuario">Eliminar Usuario</a></li>
    </ul>
    <ul>
        <li><a href="$rutaCrearResultado">Crear Resultado</a></li>
    </ul>
    <ul>
        <li><a href="$rutaEliminarResultado">Eliminar Resultado</a></li>
    </ul>
    <ul>
        <li><a href="$rutaActualizarUsuario">Actualizar Usuario</a></li>
    </ul>
    <ul>
        <li><a href="$rutaActualizarResultado">Actualizar Resultado</a></li>
    </ul>
    MARCA_FIN;
}

function funcionListadoUsuarios(): void
{
    $entityManager = DoctrineConnector::getEntityManager();

    $userRepository = $entityManager->getRepository(User::class);
    $users = $userRepository->findAll();
    echo json_encode($users);
}

function funcionListadoResultados(): void
{
    $entityManager = DoctrineConnector::getEntityManager();

    $resultRepository = $entityManager->getRepository(Result::class);
    $results = $resultRepository->findAll();
    echo json_encode($results);
}


function funcionUsuario(string $name): void
{
    echo $name;
}

function funcionCrearUsuario(): void
{
    echo <<< HTML
<form action="/create_user" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>

    <input type="submit" value="Crear Usuario">
</form>

HTML;

    require_once __DIR__ . '/scripts/create_user_web.php';
}

function funcionEliminarUsuario(): void
{
    echo <<< HTML
    <form action="/delete_user" method="post">
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required>
        <button type="submit">Eliminar Usuario</button>
    </form>
HTML;
    require_once __DIR__ . '/scripts/delete_user_web.php';
}

function funcionCrearResultado(): void
{
    echo <<< HTML
    <form action="/create_result" method="post">
        <label for="result">Result:</label>
        <input type="text" id="result" name="result" required><br>

        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required><br>

        <input type="submit" value="Crear Resultado">
    </form>
HTML;
    require_once __DIR__ . '/scripts/create_result_web.php';
}

function funcionEliminarResultado(): void
{
    echo <<< HTML
    <form action="/delete_result" method="post">
        <label for="resultId">Result ID:</label>
        <input type="text" id="resultId" name="resultId" required><br>

        <input type="submit" value="Eliminar Resultado">
    </form>
HTML;
    require_once __DIR__ . '/scripts/delete_result_web.php';
}

function funcionActualizarUsuario(): void
{
    echo <<< HTML
    <form action="/update_user" method="post">
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required><br>

        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername" name="newUsername" required><br>

        <label for="newEmail">New Email:</label>
        <input type="email" id="newEmail" name="newEmail" required><br>

        <label for="newPassword">New Password:</label>
        <input type="password" id="newPassword" name="newPassword" required><br>

        <input type="submit" value="Actualizar Usuario">
    </form>
HTML;
    require_once __DIR__ . '/scripts/update_user_web.php';
}

function funcionActualizarResultado(): void
{
    echo <<< HTML
    <form action="/update_result_by_user" method="post">
        <label for="userId">User ID:</label>
        <input type="text" id="userId" name="userId" required><br>

        <label for="newResultValue">New Result Value:</label>
        <input type="text" id="newResultValue" name="newResultValue" required><br>

        <input type="submit" value="Actualizar Resultado por Usuario">
    </form>
HTML;
    require_once __DIR__ . '/scripts/update_result_by_user_id_web.php';
}





