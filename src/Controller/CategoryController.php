<?php


namespace App\Controller;


use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class CategoryController extends AbstractController
{
    /**
     * @Route("/category/all",name="category.index")
     */
    public function index(CategoryRepository $categoryRepository):Response
    {
        $results = $categoryRepository->findAll();
        return $this->render('category/index.html.twig',[
            'categories' => $results
        ]);
    }

    /**
     * @Route("/category/{id}",name="category.detail")
     */
    public function detail(int $id, CategoryRepository $categoryRepository, ProductRepository $productRepository) : Response
    {
        $category = $categoryRepository->find($id);
        $products = $productRepository->findBy(['category' => $id]);

        return $this->render('category/detail.html.twig',[
            'category' => $category,
            'products' => $products
        ]);
    }
}