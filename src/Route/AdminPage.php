<?php

namespace Blog\Route;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;

class AdminPage
{
    public function __construct(Environment $view)
    {
        $this->view=$view;
    }
    public function __invoke(ServerRequestInterface $request ,ResponseInterface $response): ResponseInterface
    {
        $body=$this->view->render('admin/index.twig');
        $response->getBody()->write("$body");
        return $response;
    }
}