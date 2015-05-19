<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('JazzywebAulasMentorNotasFrontendBundle:Default:index.html.twig', array('name' => $name));
    }
}
