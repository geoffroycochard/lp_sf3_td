<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $sp = $this->get('blog.slugifier.provider');
        die($sp->slugify('cou cou'));
        die();
        return $this->render('BlogBundle:Default:index.html.twig', [
            'variable' => 'mavar'
        ]);
    }
}
