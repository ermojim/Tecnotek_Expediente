<?php
namespace Tecnotek\ExpedienteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 *
 * @ORM\Table(name="tek_route")
 * @ORM\Entity()
 * @UniqueEntity("code")
 */
class Route
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", unique=true)
     * @Assert\NotBlank()
     * @Assert\Min(limit = 1)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=60)
     * @Assert\NotBlank()
     * @Assert\MinLength(limit = 3)
     * @Assert\MaxLength(limit = 60)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=120, nullable = true)
     * @Assert\MaxLength(limit = 120)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable = true)
     * @Assert\MaxLength(limit = 255)
     */
    private $mapUrl;

    public function __construct()
    {
        $this->mapUrl = "";
    }

    public function __toString()
    {
        return $this->code . " :: " . $this->name;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param integer $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return integer 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set mapUrl
     *
     * @param string $mapUrl
     */
    public function setMapUrl($mapUrl)
    {
        $this->mapUrl = $mapUrl;
    }

    /**
     * Get mapUrl
     *
     * @return string 
     */
    public function getMapUrl()
    {
        return $this->mapUrl;
    }
}