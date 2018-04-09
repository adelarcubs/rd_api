<?php
declare(strict_types = 1);
namespace App\Handler;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\Customer;

class RegisterHandler implements RequestHandlerInterface
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
        $inCookie = $json['cookie'];

        $start = mb_stripos($inCookie, "=") + 1;

        $cookie = mb_substr($inCookie, $start);

        $customer = new Customer($json['name'], $json['email'], $cookie);

        $this->entityManager->persist($customer);
        $this->entityManager->flush();

        return new JsonResponse($json);
    }
}
