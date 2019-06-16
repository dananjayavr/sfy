<?php


namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\AchatRepository;
use App\Repository\CategoryRepository;
use App\Repository\ClientRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// l'annotation route est utilisée pour la classe permet de préfixer toutes les routes de la classe.

/**
 * @Route("/admin")
 */
class AchatsController extends AbstractController
{
    /**
     * @Route("/achats/all",name="admin.achats.all")
     */
    public function all(Request $request, EntityManagerInterface $entityManager, AchatRepository $achatRepository, ClientRepository $clientRepository, ProductRepository $productRepository):Response
    {
        $achats = $achatRepository->findAll();
        
        return $this->render('admin/achats/index.html.twig',[
            'achats' => $achats
        ]);
    }
}