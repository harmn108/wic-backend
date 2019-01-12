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
 * ZipCode
 *
 * @ORM\Entity
 * @ORM\Table(name="zip_code",
 *    uniqueConstraints={
 *        @UniqueConstraint(name="zip_code_unique_combination",
 *            columns={"country", "zip_code"})
 * })
 *
 */
class ZipCode
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"place", "zip_code"})
     */
    protected $id;

    /**
     * @var Country $country
     * @ORM\ManyToOne(targetEntity="Country")
     * @ORM\JoinColumn(name="country", nullable=true, referencedColumnName="id", onDelete="SET NULL")
     * @Groups({"place", "zip_code"})
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="zip_code", type="string", length=64)
     * @Assert\NotBlank(message="zip code cannot be empty!")
     * @Groups({"place", "zip_code"})
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
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param Country $country
     */
    public function setCountry(Country $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }
}