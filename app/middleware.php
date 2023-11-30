<?php

declare(strict_types=1);

use Slim\App;
use App\Application\Middleware\ExampleBeforeMiddleware;
use App\Application\Middleware\ExampleAfterMiddleware;

return function(App $app){
    // Add Global Middleware
    $settings = $app->getContainer()->get('settings');
    $app->addErrorMiddleware(
        $settings['displayErrorDetails'], 
        $settings['logErrors'], 
        $settings['logErrorDetails'
    ]);
    $app->add(ExampleBeforeMiddleware::class);
    $app->add(ExampleAfterMiddleware::class);
};