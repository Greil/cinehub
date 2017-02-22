<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 14:42
 */
declare(strict_types = 1);

namespace Actor\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Actor
 * @package Actor\Entity
 * @ORM\Entity(repositoryClass="Actor\Repository\ActorRepository")
 * @ORM\Table(name="acteur")
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=50)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $lastname;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthDate;



    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param DateTime $birthDate
     */
    public function setBirthDate(DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
}
