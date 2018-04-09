<?php
declare(strict_types = 1);
namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Track;

class TrackHandler implements RequestHandlerInterface
{

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $body = $request->getBody()->__toString();

        $json = (array) json_decode($body, true);
        $trackCode = $json['trackCode'];

        $start = mb_stripos($trackCode, "=") + 1;

        $cookie = mb_substr($trackCode, $start);

        $track = new Track($json['URL'], $cookie);

        $this->entityManager->persist($track);
        $this->entityManager->flush();

        return new JsonResponse($json);
    }
}
