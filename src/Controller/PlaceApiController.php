<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Controller;

use App\Entity\Country;
use App\Entity\Place;
use App\Service\Zippopotam;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Swagger\Annotations as SWG;
use Symfony\Component\Validator\Constraints\Email as EmailConstraint;

/**
 * Class PlaceApiController
 * @package App\Controller
 *
 * @Route("/api/v1/place")
 */
class PlaceApiController extends Controller
{
    /**
     * @Route("/get-by-filter/{parameters}", methods={"GET"}, name="get_aplaces_by_filter_action")
     * @param $parameters
     * @param Request $request
     * @param Zippopotam $zippopotam
     *
     * @SWG\Parameter( name="X-API-TOKEN", in="header", required=true, type="string", description="Authorization token" ),
     * @SWG\Response(
     *     response=200,
     *     description="Returns Places list",
     * ),
     * @SWG\Tag(name="Place")
     * @return JsonResponse
     */
    public function getByFilterApplicationAction($parameters, Request $request, Zippopotam $zippopotam)
    {
        $token = $request->headers->get('X-API-TOKEN');

        $xApiToken = $this->getParameter('x_api_token');

        // token validation
        if ($token !== $xApiToken) {
            return new JsonResponse(Response::$statusTexts[Response::HTTP_UNAUTHORIZED], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();

        $parameters = json_decode($parameters, true);

        $country = $parameters['country'];
        $zipCode = $parameters['zip_code'];

        /**
         * @var $countryObj Country
         */
        $countryObj = $em->getRepository(Country::class)->findOneBy(['code' => mb_strtolower($country)]);

        if(!$countryObj) {
            return new JsonResponse(['message' => 'Country Code Not Available'], Response::HTTP_BAD_REQUEST);
        }

        $parameters['country'] = $countryObj->getId();

        /**
         * @var $places Paginator
         */
        $places = $em->getRepository(Place::class)->getPlacesByFilter($parameters);

        if(!$places || !$places->count()) {

            /**
             * @var $zippopotam Zippopotam
             */
            $zippopotam->searchAndStorePlaces($countryObj, $zipCode);

            $places = $em->getRepository(Place::class)->getPlacesByFilter($parameters);
        }

        $placesList = self::serializerPlaces($places);

        $placesCount = $places ? $places->count() : 0;

        return new JsonResponse(['result' => $placesList, 'count' => $placesCount]);
    }

    private function serializerPlaces($places) {
        $placesList = [];

        if($places) {
            /**
             * @var $serializer Serializer
             */
            $serializer = $this->get('serializer');

            $placesList = $serializer->normalize($places, null, ['groups' => ['place']]);
        }

        return $placesList;
    }
}