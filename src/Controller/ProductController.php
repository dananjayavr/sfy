<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/products", name="product.index")
     */
    public function index(ProductRepository $productRepository):Response
    // récupération de tous les produits
    {
        $results = $productRepository->findAll();
        return $this->render('product/index.html.twig', [
            'products' => $results
        ]);
    }

    /**
     * @Route("/product/{id}",name="product.detail")
     */
    public function detail(int $id, ProductRepository $productRepository):Response
    // récupération d'un seul produit
    {
        $result = $productRepository->find($id);
        return $this->render('product/detail.html.twig',[
            'product' => $result
        ]);
    }
}
