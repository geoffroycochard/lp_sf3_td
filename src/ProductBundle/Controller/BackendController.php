<?php

namespace ProductBundle\Controller;

use ProductBundle\Entity\Category;
use ProductBundle\Entity\Product;
use ProductBundle\Entity\Variation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class BackendController
 * @package ProductBundle\Controller
 *
 * @Route("/backend")
 */
class BackendController extends Controller
{
    /**
     * @Route("/index", name="backend_product_index")
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('ProductBundle:Product')->findAll();

        return $this->render('ProductBundle:Backend:index.html.twig', array(
            'products' => $products
        ));
    }

    /**
     * @Route("/create", name="backend_product_create")
     */
    public function createAction()
    {
        // Generate Product
        $vp = rand(0,100);
        $title = sprintf('Produit %s', $vp);

        if ($product = $this->getDoctrine()->getRepository('ProductBundle:Product')->findOneBy(['title' => $title])) {
            $this->addFlash('notice', sprintf('Produit existant %s', $product->getTitle()));
            return $this->redirectToRoute('backend_product_show', ['product' => $product->getId()]);
        }

        $product = new Product();
        $product->setTitle($title);
        $product->setAbstract(sprintf('Produit absctract %s', $vp));
        $product->setDescription(sprintf('Produit description %s', $vp));

        // Attach to new categories or not ...
        for ($i = 0; $i < 3; $i++) {
            $vc = rand(0,5);
            $title = sprintf('Category %s', $vc);
            $category = $this->getDoctrine()->getRepository('ProductBundle:Category')->findOneBy(['title' => $title]);
            if(!$category) {
                $category = new Category();
                $category->setTitle($title);
                $this->addFlash('notice', sprintf('Nouvelle catégorie %s', $category->getTitle()));
            }
            if (!$product->getCategories()->contains($category)) {
                $product->addCategory($category);
            }
        }

        // Add variations
        # TODO : variation unique relation produit : merge to model
        for ($i = 1; $i < 4; $i++) {
            $vv = rand(0,5);
            $title = sprintf('Variation %s', $vv);
            $variation = new Variation();
            $variation->setTitle($title);
            $variation->setPrice(rand(10,50));
            $variation->setProduct($product);
            $product->addVariation($variation);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        $this->addFlash('notice', sprintf('Nouveau produit %s', $product->getTitle()));
        return $this->redirectToRoute('backend_product_show', ['product' => $product->getId()]);

    }

    /**
     * @Route("/show/{product}", name="backend_product_show")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Product $product)
    {
        return $this->render('ProductBundle:Backend:show.html.twig', array(
            'product' => $product
        ));
    }

}
