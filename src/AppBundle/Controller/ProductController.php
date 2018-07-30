<?php

namespace AppBundle\Controller;



use AppBundle\Entity\Category;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="product_list")
     * @Template()
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findActive();

        return ['products' => $products];
    }

    /**
     * @Route("/product/{id}", name="product_item", requirements={"id": "[0-9]+"})
     * @Template()
     */

    public function showAction($id)
    {
        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Product not found');
        }
        return ['product' => $product];
    }

    /**
     * @Route("/category/{id}", name="category_item", requirements={"id": "[0-9]+"})
     * @Template()
     * @param Category $category
     * @return array
     */
    public function listByCategoryAction(Category $category)
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findByCategory($category)
        ;
        if (!$products) {
            throw $this->createNotFoundException('Product not found');
        }
        return ['products' => $products];
    }
}