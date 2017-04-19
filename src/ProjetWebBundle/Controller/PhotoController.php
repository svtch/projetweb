<?php
/**
 * Created by IntelliJ IDEA.
 * User: rfezr
 * Date: 18/04/2017
 * Time: 09:58
 */

namespace ProjetWebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ProjetWebBundle\Entity\Activity;
use ProjetWebBundle\Form\ActivityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use ProjetWebBundle\Form\PhotosType;
use ProjetWebBundle\Entity\Photos;

//use ProjetWebBundle\Form\PhotosType;

class PhotoController extends Controller
{
    /**
     * @Route("/activity/{activityId}", name="add_photo", requirements={"activityId": "\d+"})
     */
    public function addPhoto(Request $request, $activityId){

        $activity2 = $this->getDoctrine()->getRepository("ProjetWebBundle:Activity") ->find($activityId);
        $activity = $this->getDoctrine()->getRepository("ProjetWebBundle:Photos") ->findBy(['activity' => $activity2]);

        if($activity2  == null) {
            throw new NotFoundHttpException("activity id ".$activity2." not found");
        }

        $photo = new Photos();

        $form = $this->get('form.factory')->create(PhotosType::class, $photo);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
//            We use the function addLine on Bill.php to add a line
            $activity2->addPhoto($photo);
            $em->persist($activity2);
            $em->flush();
            return $this->render('ProjetWebBundle:Activity:addPhoto.html.twig', ['activity' => $activity2, 'photos' => $activity, 'form' => $form->createView()]);

            //$this->getFlashBag()->add('success', 'Le détail a bien été enregistré');
        }


        return $this->render('ProjetWebBundle:Activity:addPhoto.html.twig', ['activity' => $activity2, 'photos' => $activity, 'form' => $form->createView()]);
    }

}
