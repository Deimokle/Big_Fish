<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


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
    public function indexAction()
    {

        return $this->render('');
    }
}