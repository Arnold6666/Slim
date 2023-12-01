<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as RequestInterface;
use Slim\Routing\RouteCollectorProxy;

return function(App $app){
    $app->get('/user/{name}', function (RequestInterface $request, ResponseInterface $response, $args) {
        $name = $args['name'];
        $response->getBody()->write("Hello, $name");	
        return $response;
    });

    $container = $app->getContainer();

    $app->group('',function (RouteCollectorProxy $view)
    {
        $view->get('example/{name}',function($request,$response,$args){
            $view = 'example.twig';
            $name = $args['name'];

            // ['name'= > $name] = compact('name')
            return $this->get('view')->render($response, 'example.twig',compact('name'));
        });
        $view->get('/views/{name}',function($request,$response,$args){
            $view = 'example.twig';
            $name = $args['name'];

            return $this->get('view')->render($response, $view, compact('name'));
        });
    })->add($container->get('viewMiddleware'));
};