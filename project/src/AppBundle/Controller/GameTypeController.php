<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GameTypeController extends Controller
{
    /**
     * @Route("/gametype/{gametype}", name="gametype_page")
     */
    public function indexAction(Request $request, $gametype)
    {
        // replace this example code with whatever you need
        return $this->render('gametype/' . $gametype . '.html.twig');
    }
}