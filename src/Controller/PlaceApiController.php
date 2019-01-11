<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Controller;

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
     * @SWG\Parameter( name="X-API-TOKEN", in="header", required=true, type="string", description="Authorization token" ),
     * @SWG\Response(
     *     response=200,
     *     description="Returns Places list",
     * ),
     * @SWG\Tag(name="Place")
     * @return JsonResponse
     */
    public function getByFilterApplicationAction($parameters, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $parameters = json_decode($parameters, true);

//        echo "<pre>"; print_r($parameters); echo "</pre>"; die();
//        $applications = $em->getRepository(Place::class)->getApplicationByFilter($parameters);
//
//        $applicationsList = [];
//        if ($applications) {
//            /**
//             * @var $serializer Serializer
//             */
//            $serializer = $this->get('serializer');
//
//            $applicationsList = $serializer->normalize($applications, null, ['groups' => ['application']]);
//        }
//        $appIds = [];
//        foreach ($applicationsList as $application) {
//            $appIds[] = $application[0]['id'];
//        }
//
//        $sdList = $em->getRepository(SecretariatDecisions::class)->getSecretariatDecisionsByApplication($appIds);
//        $sdList = $serializer->normalize($sdList, null, ['groups' => ['secretariat_decisions_fields']]);
//
//        foreach ($applicationsList as $key => $app) {
//            $applicationsList[$key][0]['secretariatDecisions'] = [];
//
//            foreach ($sdList as $item) {
//                if ($app[0]['id'] == $item['application']['id']) {
//                    $applicationsList[$key][0]['secretariatDecisions'][] = $item;
//                };
//            }
//        }

        return new JsonResponse(['result' => $parameters]);
    }

}