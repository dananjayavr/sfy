<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendController extends AbstractController
{
    private $friends = [
        0 => [
            'id' => 0,
            'nom' => 'Partridge',
            'prenom' => 'Alan',
            'email' => 'alanpartridge@bbc.co.uk',
            'photo' => 'https://pbs.twimg.com/profile_images/378800000571407909/b1aecc669efde47bd4ab8e7a7f562227.jpeg'
        ],
        1 => [
            'id' => 1,
            'nom' => 'Angel of the Eastern Gate',
            'prenom' => 'Aziraphale',
            'email' => 'aziraphale@heaven.god.co.uk',
            'photo' => 'https://pbs.twimg.com/profile_images/651777452973391872/gl5TS_sA_400x400.jpg'
        ],
        2 => [
            'id' => 2,
            'nom' => 'Crowley',
            'prenom' => 'Anthony J.',
            'email' => 'crowley@gov.co.uk',
            'photo' => 'https://pbs.twimg.com/profile_images/378800000685039156/bb2e4db7d7b78952e8c545666b90d97e.jpeg'
        ],
    ];
    /**
     * @Route("/friends",name="friends.index")
     */
    public function index():Response
    {
        return $this->render('friends/index.html.twig',[
            'friends' => $this->friends
        ]);
    }

    /**
     * @Route("/friends/{id}",name="friends.detail")
     */
    public function detail(int $id):Response
    {
        return $this->render('friends/friend.html.twig',[
            'friend' => $this->friends[$id]
        ]);
    }
}