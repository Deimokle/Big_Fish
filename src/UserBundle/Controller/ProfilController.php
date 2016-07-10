<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProfilController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findAll();
        $users = $em->getRepository('AppBundle:User')->findAll();


        return $this->render('AppBundle:Default:profile.html.twig', array(
            'users' => $users,
            'events' => $events,

        ));
    }
}
