<?php


namespace App\Controller\Admin;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Faker\Factory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// l'annotation route est utilisée pour la classe permet de préfixer toutes les routes de la classe.

/**
 * @Route("/admin")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/client/add",name="admin.client.add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository):Response
    {
        $faker = Factory::create();
        $entityManager = $this->getDoctrine()->getManager();

        $client = new Client();
        $client->setName($faker->name());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($client);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new client with id '.$client->getId());
    }

    /**
     * @Route("/client/all",name="admin.client.all")
     */
    public function all(Request $request, EntityManagerInterface $entityManager, ClientRepository $clientRepository):Response
    {
        $clients = $clientRepository->findAll();
        return $this->render('admin/client/index.html.twig',[
            'clients' => $clients
        ]);
    }

    /**
     * @Route("/client/view/{id}",name="admin.client.view")
     */
    public function view(int $id, ClientRepository $clientRepository, EntityManagerInterface $entityManager):Response
    {
        $client = $clientRepository->find($id);
        return $this->render('admin/client/view.html.twig',[
            'client' => $client
        ]);
    }
}