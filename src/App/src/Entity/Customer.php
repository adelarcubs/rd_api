<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Customer")
 */
class Customer
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     *
     * @var string
     */
    private $id;

    /**
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @var string
     */
    private $name;

    /**
     * @ORM\Column(name="email", type="string", length=255)
     *
     * @var string
     */
    private $email;

    /**
     * @ORM\Column(name="cookie", type="string", length=255)
     *
     * @var string
     */
    private $cookie;

    public function __construct($name, $email, $cookie)
    {
        $this->name = $name;
        $this->email = $email;
        $this->cookie = $cookie;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCookie()
    {
        return $this->cookie;
    }
}
