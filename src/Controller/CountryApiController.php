<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Controller;

use App\Entity\Country;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Swagger\Annotations as SWG;

/**
 * Class CountryApiController
 * @package App\Controller
 *
 * @Route("/api/v1/country")
 */
class CountryApiController extends Controller
{
    /**
     * @Route("/all", methods={"GET"}, name="get_countries")
     * @param Request $request
     * @SWG\Parameter( name="X-API-TOKEN", in="header", required=true, type="string", description="Authorization token" ),
     * @SWG\Response(
     *     response=200,
     *     description="Returns countries list",
     * ),
     * @SWG\Tag(name="Country")
     * @return JsonResponse
     */
    public function getAllCountriesAction(Request $request)
    {
        $token = $request->headers->get('X-API-TOKEN');

        $xApiToken = $this->getParameter('x_api_token');

        // token validation
        if ($token !== $xApiToken) {
            return new JsonResponse(Response::$statusTexts[Response::HTTP_UNAUTHORIZED], Response::HTTP_UNAUTHORIZED);
        }

        $em = $this->getDoctrine()->getManager();

        $countries = $em->getRepository(Country::class)->findAll();

        $countriesList = [];

        if ($countries) {
            /**
             * @var $serializer Serializer
             */
            $serializer = $this->get('serializer');

            $countriesList = $serializer->normalize($countries, null, ['groups' => ['country']]);
        }

        return new JsonResponse(['result' => $countriesList]);
    }

}