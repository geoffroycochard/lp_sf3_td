<?php

namespace PageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PageBundle\Entity\Page;


class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('PageBundle:Default:index.html.twig');
    }

    /**
    * @Route("create-page")
    */
    public function createAction()
    {

      $page = new Page();
      $page->setTitle('cocsdfou');
      $page->setMenu('coucu opmensdfu');
      $page->setContent('cu contenu');

      $em = $this->getDoctrine()->getManager();

      $em->persist($page);
      $em->flush();

            var_dump($page);
            die();
            # code...
    }
}
