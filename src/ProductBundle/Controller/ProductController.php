<?php

namespace ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("products", name="product_list")
     */
    public function listAction()
    {

        $products = [
            [
                'id' => 1,
                'title' => 'product 1'
            ],
            [
                'id' => 2,
                'title' => 'product 2'
            ],
            [
                'id' => 3,
                'title' => 'product 3'
            ],
            [
                'id' => 4,
                'title' => 'product 4'
            ],
            [
                'id' => 4,
                'title' => 'product 5'
            ]
        ];

        return $this->render('ProductBundle:Product:list.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("product/{id}", name="product_single")
     */
    public function singleAction($id)
    {

        $product = [
            'title' => sprintf('Product %s', $id)
        ];

        return $this->render('ProductBundle:Product:single.html.twig', array(
            'product' => $product
        ));
    }

}
