<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Application
 *
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationRepository")
 * @ORM\Table(name="application")
 *
 */
class Application
{
    public static $statuses = [
        0 => 'New submission',
        1 => 'Eligible',
        2 => 'Ineligible'
        /*3 => 'Semi-finalist',
        4 => 'Finalist',
        5 => 'Duplicate',
        6 => 'Update_to'*/
    ];

    public static $statuseColor = [
        0 => 'fed300',
        1 => '008000',
        2 => 'ff0000'
    ];

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\Choice(choices={"Ms", "Miss", "Mrs", "Mr", "Dr", "Professor"}, message="Invalid title value")
     * @Assert\NotBlank(message="title value cannot be empty!")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank(message="first_name value cannot be empty!")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank(message="last_name value cannot be empty!")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * ),
     *
     * @ORM\Column(name="email", type="string", length=64)
     * @Assert\NotBlank(message="email value cannot be empty!")
     *
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=64, nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string", length=64, nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=64, nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=64, nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="street_address", type="string", length=64, nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $streetAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50)
     * @Assert\NotBlank(message="phone value cannot be empty!")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $phone;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="research_proposal", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $researchProposal;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="cv", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $cv;

    /**
     * @var string
     *
     *
     * @ORM\Column(name="cover", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $cover;

    /**
     * @var string
     *
     * @ORM\Column(name="additional", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $additional;

    /**
     * @var string
     *
     * @ORM\Column(name="recommendation_first", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $recommendationFirst;

    /**
     * @var string
     *
     * @ORM\Column(name="recommendation_second", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $recommendationSecond;

    /**
     * @var string
     *
     * @ORM\Column(name="recommendation_third", length=255, type="string", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $recommendationThird;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $status = 0;

    /**
     * @Assert\DateTime()
     * @ORM\Column(name="created", type="datetime", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $comment;

    /**
     * @var integer
     *
     * @ORM\Column(name="experts_count", type="integer")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $expertsCount = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="translates_count", type="integer")
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $translatesCount = 0;

    /**
     *
     * @ORM\Column(name="additional_files_json", type="json", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $additionalFilesJson;

    /**
     * @var string
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     * @Groups({"application", "log_fields", "voting_fields", "secretariat_decisions_fields"})
     */
    private $tags;


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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince(string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getResearchProposal()
    {
        return $this->researchProposal ? '/uploads/applications/' . $this->getId() . '/' . $this->researchProposal : null;
    }

    /**
     * @param mixed $researchProposal
     */
    public function setResearchProposal($researchProposal): void
    {
        $this->researchProposal = $researchProposal;
    }

    /**
     * @return mixed
     */
    public function getCv()
    {
        return $this->cv ? '/uploads/applications/' . $this->getId() . '/' . $this->cv : null;
    }

    /**
     * @param mixed $cv
     */
    public function setCv($cv): void
    {
        $this->cv = $cv;
    }

    /**
     * @return mixed
     */
    public function getCover()
    {
        return $this->cover ? '/uploads/applications/' . $this->getId() . '/' . $this->cover : null;
    }

    /**
     * @param mixed $cover
     */
    public function setCover($cover): void
    {
        $this->cover = $cover;
    }

    /**
     * @return string
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * @param string $additional
     */
    public function setAdditional(string $additional): void
    {
        $this->additional = $additional;
    }

    /**
     * @return string
     */
    public function getRecommendationFirst()
    {
        return $this->recommendationFirst ? '/uploads/applications/' . $this->getId() . '/' . $this->recommendationFirst : null;
    }

    /**
     * @param string $recommendationFirst
     */
    public function setRecommendationFirst(string $recommendationFirst): void
    {
        $this->recommendationFirst = $recommendationFirst;
    }

    /**
     * @return string
     */
    public function getRecommendationSecond()
    {
        return $this->recommendationSecond ? '/uploads/applications/' . $this->getId() . '/' . $this->recommendationSecond : null;
    }

    /**
     * @param string $recommendationSecond
     */
    public function setRecommendationSecond(string $recommendationSecond): void
    {
        $this->recommendationSecond = $recommendationSecond;
    }

    /**
     * @return string
     */
    public function getRecommendationThird()
    {
        return $this->recommendationThird ? '/uploads/applications/' . $this->getId() . '/' . $this->recommendationThird : null;
    }

    /**
     * @param string $recommendationThird
     */
    public function setRecommendationThird(string $recommendationThird): void
    {
        $this->recommendationThird = $recommendationThird;
    }

    /**
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->streetAddress;
    }

    /**
     * @param string $streetAddress
     */
    public function setStreetAddress(string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     */
    public function setCreated($created): void
    {
        $this->created = $created;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getExpertsCount()
    {
        return $this->expertsCount;
    }

    /**
     * @param string $expertsCount
     */
    public function setExpertsCount(string $expertsCount): void
    {
        $this->expertsCount = $expertsCount;
    }

    /**
     * @return int
     */
    public function getTranslatesCount()
    {
        return $this->translatesCount;
    }

    /**
     * @param int $translatesCount
     */
    public function setTranslatesCount(int $translatesCount): void
    {
        $this->translatesCount = $translatesCount;
    }

    /**
     * @return mixed
     */
    public function getAdditionalFilesJson()
    {
        if ($this->additionalFilesJson) {
            $additionalFilesLinks = [];
            $additionalFiles = json_decode($this->additionalFilesJson, true);
            if ($additionalFiles) {
                foreach ($additionalFiles as $file){
                    $additionalFilesLinks[] = '/uploads/applications/' . $this->getId() . '/' . $file;
                }

                return json_encode($additionalFilesLinks);
            } else {
                return null;
            }
        }

        return null;
    }

    /**
     * @param mixed $additionalFilesJson
     */
    public function setAdditionalFilesJson($additionalFilesJson): void
    {
        $this->additionalFilesJson = $additionalFilesJson;
    }

    /**
     * @return string
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param string $tags
     */
    public function setTags(string $tags): void
    {
        $this->tags = $tags;
    }
}