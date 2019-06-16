<?php


namespace App\Controller;

use App\Entity\Achat;
use App\Repository\AchatRepository;
use App\Repository\ClientRepository;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class BuyController extends AbstractController
{
    /**
     * @Route("/buy",name="buy.index")
     */
    public function buy(ProductRepository $productRepository, ClientRepository $clientRepository, EntityManagerInterface $entityManager, AchatRepository $achatsRepository):Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $achat = new Achat();
        $product = $productRepository->find(rand(1,4));
        $client = $clientRepository->find(rand(1,11));

        $achat->setClientId($client->getId());
        $achat->setProductId($product->getId());

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($achat);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved for client '.$client->getId().' product '. $product->getId());
    }
}