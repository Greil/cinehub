<?php
/**
 * User: remi_k
 * Date: 21/02/2017
 * Time: 15:55
 */
declare(strict_types = 1);


namespace Film\Entity;

use Director\Entity\Director;
use Genre\Entity\Genre;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Film
 * @package Film\Entity
 * @ORM\Entity(repositoryClass="Film\Repository\FilmRepository")
 * @ORM\Table(name="film")
 */
class Film
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
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="synopsis", type="text")
     */
    private $synopsis;

    /**
     * @var int
     *
     * @ORM\Column(name="release_year", type="integer", length=4)
     */
    private $releaseYear;

    /**
     * @var double
     *
     * @ORM\Column(name="note", type="decimal", precision=3, scale=2)
     */
    private $note;

    /**
     * @var Director
     *
     * @ORM\ManyToOne(targetEntity="Director\Entity\Director", inversedBy="films")
     */
    private $director;

    /**
     * @var Genre
     *
     * @ORM\ManyToOne(targetEntity="Genre\Entity\Genre", inversedBy="films")
     */
    private $genre;



    /**
     * @return mixed
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * @param string $synopsis
     */
    public function setSynopsis(string $synopsis)
    {
        $this->synopsis = $synopsis;
    }

    /**
     * @return int
     */
    public function getReleaseYear()
    {
        return $this->releaseYear;
    }

    /**
     * @param int $releaseYear
     */
    public function setReleaseYear(int $releaseYear)
    {
        $this->releaseYear = $releaseYear;
    }

    /**
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param float $note
     */
    public function setNote(float $note)
    {
        $this->note = $note;
    }

    /**
     * @return Genre
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param Genre $genre
     */
    public function setGenre(Genre $genre)
    {
        $this->genre = $genre;
    }

    /**
     * @return Director
     */
    public function getDirector()
    {
        return $this->director;
    }

    /**
     * @param Director $director
     */
    public function setDirector(Director $director)
    {
        $this->director = $director;
    }
}
