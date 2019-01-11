<?php
/**
 * Created by PhpStorm.
 * User: harut
 */

namespace App\Controller;

use App\Entity\Application;
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
 * Class ApplicationApiController
 * @package App\Controller
 *
 * @Route("/api/v1/application")
 */
class ApplicationApiController extends Controller
{
    /**
     * @Route("/add", methods={"Post"}, name="add_archive"),
     * @param Request $request
     *
     * @SWG\Post(
     *     consumes={"multipart/form-data"},
     *     @SWG\Parameter(name="X-API-TOKEN", in="header", required=true, type="string", description="Authorization token" ),
     *     @SWG\Parameter(name="from_date", in="formData", type="string"),
     *     @SWG\Parameter(name="to_date", in="formData", type="string"),
     *
     *     tags={"Application"},
     *     @SWG\Response(
     *         response="200",
     *         description="Add Archive"
     *     )
     * )
     *
     * @return JsonResponse
     *
     * */
    public function addAction(Request $request)
    {

        echo "<pre>"; print_r('test'); echo "</pre>"; die();
//        $em = $this->getDoctrine()->getManager();
//
//        $contentType = $request->getContentType();
//        if ($contentType == 'application/json' || $contentType == 'json') {
//            $content = $request->getContent();
//            $content = json_decode($content, true);
//
//            $fromDate = trim($content['from_date']);
//            $toDate = trim($content['to_date']);
//        } else {
//            $fromDate = trim($request->request->get('from_date'));
//            $toDate = trim($request->request->get('to_date'));
//        }
//
//        try {
//            $fromDate = new DateTime($fromDate);
//            $toDate = new DateTime($toDate);
//        } catch (Exception $e) {
//            return new JsonResponse(Response::$statusTexts[Response::HTTP_BAD_REQUEST], Response::HTTP_BAD_REQUEST);
//        }
//
//        try {
//            $archive = new Archive();
//            $archive->setFromDate($fromDate);
//            $archive->setToDate($toDate);
//            $archive->setCreator($user);
//            $archive->setCreated(new DateTime());
//
//            $validator = $this->get('validator');
//            $errors = $validator->validate($archive);
//
//            if (count($errors) > 0) {
//                foreach ($errors as $key => $value) {
//                    if ($value->getMessage()) {
//                        return new JsonResponse(['message' => $value->getMessage()], Response::HTTP_CONFLICT);
//                    }
//                }
//            }
//
//            $em->persist($archive);
//            $em->flush();
//
//            return new JsonResponse(['result' => ['id' => $archive->getId()]], Response::HTTP_OK);
//        } catch (\Exception $e) {
//            return new JsonResponse(['message' => 'system_error ' . $e->getMessage()], Response::HTTP_CONFLICT);
//        }
    }
}