<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WorldCupController extends AbstractController
{
    /**
     * @Route("/worldcup/winner",name="index")
     */
    public function index():Response
    {
        return $this->render('worldcup/winner.html.twig');
    }

    /**
     * @Route("/worldcup/winner/{country}/{year}",name="history")
     */
    public function history(string $country, int $year):Response
    {
        return $this->render('worldcup/history.html.twig',[
            'country' => $country,
            'year' => $year
        ]);
    }
}