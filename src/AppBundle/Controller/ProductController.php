<?php

namespace AppBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{
    /**
     * @Route("/products", name="products")
     */
    public function indexAction()
    {
        return $this->render('@App/product/index.html.twig');
    }
}