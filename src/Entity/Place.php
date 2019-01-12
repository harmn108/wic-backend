<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Place
 *
 * @ORM\Entity(repositoryClass="App\Repository\PlaceRepository")
 *
 * @ORM\Table(name="place",
 *    uniqueConstraints={
 *        @UniqueConstraint(name="place_unique_combination",
 *            columns={"name", "latitude", "longitude"})
 * })
 */
class Place
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"place"})
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank(message="place name cannot be empty!")
     * @Groups({"place"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=255)
     * @Assert\NotBlank(message="place latitude cannot be empty!")
     * @Groups({"place"})
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=255)
     * @Assert\NotBlank(message="place longitude cannot be empty!")
     * @Groups({"place"})
     */
    private $longitude;

    /**
     * @var ZipCode $zipCode
     * @ORM\ManyToOne(targetEntity="ZipCode")
     * @ORM\JoinColumn(name="zip_code", nullable=true, referencedColumnName="id", onDelete="SET NULL")
     * @Groups({"place"})
     */
    private $zipCode;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * @param string $latitude
     */
    public function setLatitude(string $latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return string
     */
    public function getLongitude(): string
    {
        return $this->longitude;
    }

    /**
     * @param string $longitude
     */
    public function setLongitude(string $longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return ZipCode
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * @param ZipCode $zipCode
     */
    public function setZipCode(ZipCode $zipCode): void
    {
        $this->zipCode = $zipCode;
    }
}