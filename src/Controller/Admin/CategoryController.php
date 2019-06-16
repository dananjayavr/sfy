<?php


namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// l'annotation route est utilisée pour la classe permet de préfixer toutes les routes de la classe.

/**
 * @Route("/admin")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/category/add",name="admin.category.add")
     * @Route("/category/edit/{id}",name="admin.category.edit")
     */
    public function add(Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository, int $id=null):Response
    {
        // création du formulaire
        $type = CategoryType::class;  //on récupère juste le nom de la classe ici. ::class renvoie le namespace de la classe
        //$entity = new Product(); // création d'une instance de l'entité liée à la formulaire
        // si $id est null, un formulaire vide, vice-versa
        is_null($id) ? $entity = new Category() : $entity = $categoryRepository->find($id);
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
            is_null($id) ? $notification = 'La catégorie a été ajoutée' : $notification = 'La catégorie a été mise à jour';

            /*
             * messages flash : informations stockées dans la session et détruits après leur lecture
             * addFlash(clé,valeur) : créer une entrée dans la session
             * $_SESSION['clé'] = valeur;
             */
            $this->addFlash('notice',$notification);

            // redirectToRoute(nom de la route à afficher): redirection
            return $this->redirectToRoute('category.index');
        }

        return $this->render('admin/category/form.html.twig',[
            'form' => $form->createView(),
            'categories' => $categoryRepository->findAll()
        ]);
    }
}