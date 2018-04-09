<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="Track")
 */
class Track
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
     * @ORM\Column(name="url", type="string", length=1000)
     *
     * @var string
     */
    private $url;

    /**
     * @ORM\Column(name="cookie", type="string", length=255)
     *
     * @var string
     */
    private $cookie;

    /**
     *
     * @ORM\Column(name="hitOn", type="datetime", nullable=false)
     *
     * @var \DateTime
     */
    private $hitOn;

    public function __construct($url, $cookie)
    {
        $this->url = $url;
        $this->cookie = $cookie;
        $this->hitOn = new DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getCookie()
    {
        return $this->cookies;
    }
}
