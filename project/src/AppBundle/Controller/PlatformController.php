<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PlatformController extends Controller
{
    /**
     * @Route("/platform", name="platform")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('platform/console.html.twig');
    }
}