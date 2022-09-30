<?php
declare(strict_types=1);

namespace Blog\Route;

use Blog\LatesPost;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class MainPage
{

    /**
     * @param LatesPost $latesPost
     * @param Environment $view
     */
    public function __construct(LatesPost $latesPost,Environment $view)
    {
        $this->latesPost=$latesPost;
        $this->view=$view;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function execute(Request $request,Response $response):Response
    {
        $posts=$this->latesPost->get(5);

        $body=$this->view->render('index.twig',[
            'posts'=>$posts
        ]);
        $response->getBody() ->write($body);
        return $response;

    }
}