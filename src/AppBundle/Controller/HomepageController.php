<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Event controller.
 *
 */
class HomepageController extends Controller
{
    /**
     * Lists all Event entities.
     *
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Event')->findAll();
        $user = $this->getUser();

        return $this->render('AppBundle:Default:homepage.html.twig', array(
            'events' => $events,
            'user' => $user,
        ));
    }
}