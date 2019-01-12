<?php

namespace App\Service;

use App\Entity\Country;
use App\Entity\Place;
use App\Entity\ZipCode;
use Doctrine\ORM\EntityManagerInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Zippopotam
{
    /**
     * @var string
     */
    private $url;

    protected $em;

    /**
     * Curl constructor.
     * @param $url
     */
    function __construct(EntityManagerInterface $em, $url)
    {
        $this->em = $em;
        $this->url = $url;
    }

    /**
     * @param Country $countryCode
     * @param $zipCode
     * @return mixed|string
     */
    public function searchAndStorePlaces(Country $countryCode, $zipCode)
    {
        $url = $this->url . '/' . mb_strtolower($countryCode->getCode()) . '/' . $zipCode;

        try {
            $client = new Client();
            $response = $client->get($url);

            $results = $response->getBody()->getContents();

            $results = json_decode($results);

            if($results && $results->places && is_array($results->places)) {
                /**
                 * @var $zipCode ZipCode
                 */
                $zipCodeFromDb = $this->em->getRepository(ZipCode::class)->findOneBy(['country' => $countryCode, 'zipCode' => $zipCode]);

                if(!$zipCodeFromDb) {
                    $zipCodeFromDb = new ZipCode();
                    $zipCodeFromDb->setCountry($countryCode);
                    $zipCodeFromDb->setZipCode($zipCode);

                    $this->em->persist($zipCodeFromDb);
                    $this->em->flush();
                }

                foreach ($results->places as $nextPlace) {
                    $nextPlace = (array)$nextPlace;
                    $placeFromDb = $this->em->getRepository(Place::class)->findOneBy(
                        [   'zipCode' => $zipCodeFromDb,
                            'latitude' => $nextPlace['latitude'],
                            'longitude' => $nextPlace['longitude'],
                            'name' => $nextPlace['place name']
                        ]);
                    if (!$placeFromDb) {
                        $placeFromDb = new Place();
                        $placeFromDb->setName($nextPlace['place name']);
                        $placeFromDb->setLatitude($nextPlace['latitude']);
                        $placeFromDb->setLongitude($nextPlace['longitude']);
                        $placeFromDb->setZipCode($zipCodeFromDb);

                        $this->em->persist($placeFromDb);
                        $this->em->flush();
                    }
                }
            }
        } catch (RequestException $e) {}
    }
}