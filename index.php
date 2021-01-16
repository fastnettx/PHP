<?php

use app\controllers\SiteControllers;
use app\core\Application;

const NAME = '/MVCblog';

require_once __DIR__ . '/vendor/autoload.php';

$app = new Application(__DIR__);
$app->router->get(NAME . '/', [SiteControllers::class, 'home']);
$app->router->get(NAME . '/add_article', [SiteControllers::class, 'add_article']);
$app->router->post(NAME . '/add_article', [SiteControllers::class, 'add_article']);
$app->router->get(NAME . '/list_articles', [SiteControllers::class, 'list_articles']);
$app->router->get(NAME . '/show', [SiteControllers::class, 'show']);
$app->router->post(NAME . '/show', [SiteControllers::class, 'show']);
$app->router->get(NAME . '/edit', [SiteControllers::class, 'edit']);
$app->router->post(NAME . '/edit', [SiteControllers::class, 'edit']);
$app->router->get(NAME . '/delete', [SiteControllers::class, 'delete']);

$app->run();