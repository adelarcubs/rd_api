<?php
declare(strict_types = 1);
namespace App\Handler;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

class TrackHandlerFactory
{

    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        $em = $container->get('doctrine.entity_manager.orm_default');

        return new TrackHandler($em);
    }
}
