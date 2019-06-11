<?php


namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// l'annotation route est utilisée pour la classe permet de préfixer toutes les routes de la classe.

/**
 * @Route("/admin")
 */
class HomepageController extends AbstractController
{
    // le nom du dossier, nom du controlleur, nom du route
    /**
     * @Route("/",name="admin.homepage.index")
     */
    public function index():Response
    {
        return $this->render('admin/homepage/index.html.twig');
    }
}