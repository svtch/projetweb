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
use ProjetWebBundle\Form\EditActivityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;

class ActivityController extends Controller
{
    /**
     * @Route("/", name="accueil")
     */
    public function indexAction()
    {
        $listValidActivity = $this->getDoctrine()->getRepository("ProjetWebBundle:Activity")->findBy(array('state' => 2), array('id' => 'DESC'), 1);


        return $this->render('ProjetWebBundle:Activity:index.html.twig', array(
            'listValidActivity' => $listValidActivity
        ));

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
    /**
     * @Route("/activity/edit/{activityId}", name="edit_activity", requirements={"activityId": "\d+"})
     */
    public function editActivityAction($activityId){
        $em = $this->getDoctrine()->getManager();

        $ActivityRepo = $this->getDoctrine()->getRepository("ProjetWebBundle:Activity");
        //Get detail by id
        $activity = $ActivityRepo->find($activityId);

        $request = $this->get('request_stack')->getCurrentRequest();

        $form = $this->get('form.factory')->create(EditActivityType::class, $activity);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($activity);
            $em->flush();

            return $this-> redirectToRoute('list_activity');
        }

        return $this->render('ProjetWebBundle:Activity:editActivity.html.twig', array(
            'form' => $form->createView(),'activityId' => $activity ));
    }

    /**
     * @Route("/activity/delete/{activityId}", name="delete_activity", requirements={"activityId": "\d+"})
     */
    public function deleteActivityAction($activityId){
        $em = $this->getDoctrine()->getManager();
        // On récupère les détail de la facture
        $activityRepo = $this->getDoctrine()->getRepository("ProjetWebBundle:Activity");
        //Get detail by id
        $activity = $activityRepo->find($activityId);

        if($activity == null){
            $this->getFlashBag()->add('error', 'invalid id');
        }
        // On assigne l'id de la facture a une autre variable pour pouvoir le returner
        $activityIdId = $activity->getId();
        // On supprime l'objet
        $em->remove($activity);
        $em->flush();

        return $this->redirectToRoute("list_activity");
    }

}