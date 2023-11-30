<?php

declare(strict_types=1);

use DI\Container;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Monolog\Processor\UidProcessor;
use Monolog\Handler\StreamHandler;
use Psr\Container\ContainerInterface;

return function(Container $container){
    $container->set(LoggerInterface::class,function(ContainerInterface $container){
        $settings = $container->get('settings');

        $loggerSettings = $settings['logger'];
        $logger = new Logger($loggerSettings['name']);

        $processer = new UidProcessor();
        $logger->pushProcessor($processer);

        $handler = new StreamHandler($loggerSettings['path'],$loggerSettings['level']);
        $logger->pushHandler($handler);
        
        return $logger;
    });
    $container->get(LoggerInterface::class)->debug('example',['context'=>'message']);
};