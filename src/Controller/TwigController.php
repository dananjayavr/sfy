<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    /**
     * @Route("/twig",name="twig.index")
     */
    public function index():Response
    {
        $my_list = [
            'key_1' => 'value_1',
            'key_2' => 'value_2',
            'key_3' => 'value_3',
            'key_4' => 'value_4',
        ];

        // Important d'utiliser '\' avant le nom de classe globale pour revenir au namespace PHP
        $today = new \DateTime('');
        //dd($today);
        return $this->render('twig/index.html.twig',[
            'my_list' => $my_list,
            'today' => $today,
            'cac40_today' => 5335.41,
            'tsla' => 205,95
        ]);
    }

}