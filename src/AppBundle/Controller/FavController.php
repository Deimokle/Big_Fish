<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Event controller.
 *
 */
class FavController extends Controller
{
    /**
     * Lists all Event entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $eventId = $request->query->get('idEvent');
        if(is_null($eventId) == false) {
            $event = $em->getRepository('AppBundle:Event')->find($eventId);
            $this->getUser()->removeEvent($event);
            $em->persist($this->getUser());
            $em->flush();
        }
        
       // $events = $em->getRepository('AppBundle:Event')->findAll();


        return $this->render('AppBundle:Default:fav.html.twig', array(
            'user' => $this->getUser(),
        ));
    }
}