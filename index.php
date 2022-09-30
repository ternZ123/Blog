<?php


use Blog\Route\AboutPge;
use Blog\Route\AdminPage;
use Blog\Route\AutPage;
use Blog\Route\AutPostPage;
use Blog\Route\GalleryPage;
use Blog\Route\MainPage;
use Blog\Route\PostPage;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;


require __DIR__ . '/vendor/autoload.php';


$builder= new ContainerBuilder();
$builder->addDefinitions('config/di.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$container=$builder->build();
AppFactory::setContainer($container);

$app = AppFactory::create();

$app->get('/', MainPage::class.':execute') ;
$app->get('/gallery[/{page}]',GalleryPage::class);
$app->get('/about', AboutPge::class);

$app->get('/admyn',  AdminPage::class);
$app->get('/aut',  AutPage::class);
$app->post('/aut-post',AutPostPage::class);
$app->get('/create',  CreatePage::class);

$app->get('/{url_key}', PostPage::class);

$app->run();