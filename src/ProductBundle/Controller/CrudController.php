<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Product;
use ProductBundle\Entity\Variation;
use ProductBundle\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class CrudController
 * @package ProductBundle\Controller
 *
 * @Route("/products/crud")
 */
class CrudController extends Controller
{
    /**
     * @Route("/index", name="product_crud_index")
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('ProductBundle:Product')->find(12);

        return $this->render('ProductBundle:Crud:index.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("/create", name="product_crud_create")
     */
    public function createAction(Request $request)
    {
        $product = new Product();
        $variation = new Variation();
        $variation->setProduct($product);
        $product->addVariation($variation);

        $form = $this->createForm(ProductType::class, $product, array());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_crud_index');
        }

        return $this->render('ProductBundle:Crud:update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/update/{product}", name="product_crud_update")
     */
    public function updateAction(Product $product, Request $request)
    {
        
        $form = $this->createForm(ProductType::class, $product, array());

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();
            $this->redirectToRoute('product_crud_index');
        }

        return $this->render('ProductBundle:Crud:update.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/show/{product}", name="product_crud_show")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Product $product)
    {

        return $this->render('ProductBundle:Crud:show.html.twig', array(
            'product' => $product
        ));
    }

    /**
     * @Route("/delete/{product}", name="product_crud_delete")
     */
    public function deleteAction(Product $product)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirectToRoute('product_crud_index');

    }

}
