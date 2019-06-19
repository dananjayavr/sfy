<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="registration.register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        // bloquer l'accès à la page lorsque l'utilsatuer est connecté
        // on peut utiliser la fonction isGranted (equivalent à la fonctino twig)
        // aussi denyAccessUnlessGranted() -> renvoie un accès refusé (403)

        // access denied unless one is admin
        //$this->denyAccessUnlessGranted('ROLE_ADMIN');

        // access denied if the user is connected
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            // here you can either redirect or display a message (flash, or otherwise)
            // nex exception
            throw new AccessDeniedException('You are not authorized to access this page.');
        }


        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email
            // message de confirmation
            $this->addFlash('notice','Votre compte a été créé.');
            // redirect to login page
            return $this->redirectToRoute('security.login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
