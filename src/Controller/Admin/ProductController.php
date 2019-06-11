<?php


namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// l'annotation route est utilisée pour la classe permet de préfixer toutes les routes de la classe.

/**
 * @Route("/admin")
 */
class ProductController extends AbstractController
{
    // le nom du dossier, nom du controlleur, nom du route
    /**
     * @Route("/products",name="admin.product.index")
     */
    public function index(ProductRepository $productRepository):Response
    {
        $products = $productRepository->findAll();
        return $this->render('admin/product/index.html.twig',[
            'products' => $products
        ]);
    }
}