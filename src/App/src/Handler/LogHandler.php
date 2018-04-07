<?php
declare(strict_types = 1);
namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Track;

class LogkHandler implements RequestHandlerInterface
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('T.*');
        $qb->from('Track', 'T');
        
        $json = $qb->getQuery()->getArrayResult();
        
        return new JsonResponse($json);
    }
}
