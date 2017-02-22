<?php
/**
 * User: remi_k
 * Date: 20/02/2017
 * Time: 11:17
 */
declare(strict_types = 1);


namespace Genre\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Genre
 * @package Genre\Entity
 * @ORM\Entity(repositoryClass="Genre\Repository\GenreRepository")
 * @ORM\Table(name="genre")
 */
class Genre
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
     * @ORM\Column(name="label", type="string", length=50)
     */
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="Film\Entity\Film", mappedBy="genre")
     */
    private $films;



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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
    }

    public function getFilms()
    {
        return $this->films;
    }
}
