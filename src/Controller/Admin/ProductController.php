<?php


namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
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

    /**
     * @Route("/products/form",name="admin.product.form")
     * @Route("/products/edit/{id}",name="admin.product.edit")
     */
    public function form(Request $request, EntityManagerInterface $entityManager, ProductRepository $productRepository, int $id=null):Response
    {
        // création du formulaire
        $type = ProductType::class;  //on récupère juste le nom de la classe ici. ::class renvoie le namespace de la classe
        //$entity = new Product(); // création d'une instance de l'entité liée à la formulaire
        // si $id est null, un formulaire vide, vice-versa
        is_null($id) ? $entity = new Product() : $entity = $productRepository->find($id);
        $form = $this->createForm($type,$entity);

        // récupération de la saisie dans $_POST
        $form->handleRequest($request);

        // si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            //dd($entity);

            // persister la requête
            $entityManager->persist($entity);

            // exécution des requêtes
            $entityManager->flush();

            // message de confirmation (en fonction de création ou modification)
            is_null($id) ? $notification = 'Le produit a été ajouté' : $notification = 'Le produit a été mis à jour';

            /*
             * messages flash : informations stockées dans la session et détruits après leur lecture
             * addFlash(clé,valeur) : créer une entrée dans la session
             * $_SESSION['clé'] = valeur;
             */
            $this->addFlash('notice',$notification);

            // redirectToRoute(nom de la route à afficher): redirection
            return $this->redirectToRoute('admin.product.index');
        }

        return $this->render('admin/product/form.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/product/delete/{id}",name="admin.product.delete")
     */
    public function delete(int $id, EntityManagerInterface $entityManager, ProductRepository $productRepository):Response
    {
        // séléction de l'entité à supprimer
        $entity = $productRepository->find($id);
        $entityManager->remove($entity);
        $entityManager->flush();

        // message de confirmation
        $notification = 'Le produit a été supprimé';

        //message flash (recommandé de garder le même message -> pas besoin de changer dans la vue)
        $this->addFlash('notice', $notification);

        // redirection
        return $this->redirectToRoute('admin.product.index');
    }

}