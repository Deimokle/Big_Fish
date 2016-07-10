<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Conf;


/**
 * Event controller.
 *
 */
class HomepageController extends Controller
{
    /**
     * Lists all Event entities.
     * @Conf\Method({"GET","POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        $eventId = $request->query->get('idEvent');
        if(is_null($eventId) == false){
            $event = $em->getRepository('AppBundle:Event')->find($eventId);
            $love = $request->query->get('love');

            if ($love == 1) {
                $user->addEvent($event);
            } else {
                $user->removeEvent($event);
            }
            $em->persist($user);
            $em->flush();
        }
        
        $events = $em->getRepository('AppBundle:Event')->findAll();
        
        
        return $this->render('AppBundle:Default:homepage.html.twig', array(
            'events' => $events,
            'user' => $user,
        ));
    }
    
    public function loveAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('AppBundle:Event')->find($id);
        $user = $this->get('security.context')->getToken()->getUser();

        $love = $request->query->get('love');
        $userId = $user->getId();
        if ($userId != null) {
            if ($love == 1) {
                $user->addEvent($event);
                $event->addUser($user);
            } else {
                $user->removeEvent($event);
                $event->removeUser($user);
            }
            $em->persist($user);
            $em->persist($event);
            $em->flush();
        }
        return $this->redirectToRoute('homepage');

    }
}