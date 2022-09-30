<?php
declare(strict_types=1);

namespace Blog\Route;

use Blog\LatesPost;
use Blog\PostMapper;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Twig\Environment;


class GalleryPage
{
    /**
     * @param Environment $view
     * @param PostMapper $postMapper
     */
    public function __construct(Environment $view,PostMapper $postMapper)
    {
        $this->postMapper=$postMapper;
        $this->view=$view;
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function __invoke(ServerRequestInterface $request ,ResponseInterface $response):ResponseInterface
    {

    $page=isset($args['page'])?(int)$args['page']:1;
    $limit=5;
    $posts=$this->postMapper->getList($page,$limit,'ASC');
    $totalCount=$this->postMapper->getTotalCount();
    $body=$this->view->render('gallery.twig',[
        'posts'=>$posts,
        'pagination'=>[
            'current'=>$page,
            'paging'=> ceil($totalCount / $limit),
        ],
    ]);
    $response->getBody() ->write($body);
    return $response;
    }

}