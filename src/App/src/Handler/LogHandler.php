<?php
declare(strict_types = 1);
namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Track;
use Doctrine\ORM\Query\Expr\Join;

class LogHandler implements RequestHandlerInterface
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $json = $this->getViews();
        
        return new JsonResponse($json);
    }

    private function getViews()
    {
        $result = $this->getQuery();
        
        $return = [];
        
        foreach ($result as $row) {
            $return[$row['email']][] = [
                'url' => $row['url'],
                'hitOn' => $row['hitOn']->format('Y-m-d H:i:s')
            ];
        }
        
        return $return;
    }

    private function getQuery()
    {
        $qb = $this->entityManager->createQueryBuilder();
        
        $qb->select([
            'C.email',
            'T.url',
            'T.hitOn'
        ]);
        $qb->from('App\Entity\Track', 'T');
        $qb->leftJoin('App\Entity\Customer', 'C', Join::WITH, 'C.cookie = T.cookie');
        
        $qb->orderBy('C.email', 'ASC');
        $qb->addOrderBy('T.hitOn', 'ASC');
        
        return $qb->getQuery()->getArrayResult();
    }
}
