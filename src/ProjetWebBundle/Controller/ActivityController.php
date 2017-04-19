<?php
/**
 * Created by IntelliJ IDEA.
 * User: rfezr
 * Date: 17/04/2017
 * Time: 18:36
 */



namespace ProjetWebBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ProjetWebBundle\Entity\Activity;
use ProjetWebBundle\Form\ActivityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class ActivityController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('ProjetWebBundle:Default:index.html.twig');
    }

    /**
     * @Route("/activity/add", name="create_activity")
     */
    public function createActivityAction(){
        $request = $this->get('request_stack')->getCurrentRequest();
        $activity = new Activity();
        $form = $this->get('form.factory')->create(ActivityType::class, $activity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();
            return $this->redirectToRoute('list_Valid_activity');
        }
        return $this->render('ProjetWebBundle:Activity:addActivity.html.twig', array(
            'form' => $form->createView(),));
    }

    /**
     * @Route("/activity/moderate", name="list_activity")
     */
    public function listActivityAction(){
        $listActivity = $this->getDoctrine()->getRepository("ProjetWebBundle:Activity")->findAll();

        return $this->render('ProjetWebBundle:Activity:listActivity.html.twig', array(
            'listActivity' => $listActivity
        ));

    }
    
    /**
     * @Route("/activity/", name="list_Valid_activity")
     */
    public function listValidActivityAction(){
        $listValidActivity = $this->getDoctrine()->getRepository("ProjetWebBundle:Activity")->findBy(array('state' => 2));
        

        return $this->render('ProjetWebBundle:Activity:listValidActivity.html.twig', array(
            'listValidActivity' => $listValidActivity
        ));

    }
}