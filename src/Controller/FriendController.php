<?php


namespace App\Controller;


use App\Repository\FriendRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FriendController extends AbstractController
{
    /**
     * @Route("/friends",name="friends.index")
     */
    public function index(FriendRepository $friendRepository):Response
    {
        $friends = $friendRepository->findAll();
        return $this->render('friends/index.html.twig',[
            'friends' => $friends
        ]);
    }

    /**
     * @Route("/friends/{id}",name="friends.detail")
     */
    public function detail(int $id, FriendRepository $friendRepository):Response
    {
        $friend = $friendRepository->find($id);
        return $this->render('friends/friend.html.twig',[
            'friend' => $friend
        ]);
    }
}