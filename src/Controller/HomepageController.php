<?php

namespace App\Controller;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{

    /*
     * @Route : permet de créer une route
     * utilisation uniquement double guillemets
     * 2 paramètres : le chemin de la route (URL) / identifiant unique de la route : permet de créer des liens entre les pages (entre les routes).
     * Nomenclature : <nom du controlleur>.<nom de la méthode>
     */

    /**
     * @Route("/",name="homepage.index")
     */
    public function index(Request $request):\Symfony\Component\HttpFoundation\Response
    {
        // appel d'une page twig
        //return new \Symfony\Component\HttpFoundation\Response('<h1>Hello, World!</h1>');

        /*
         * appel d'une vue Twig
         * les vues sont crées dans le dossier templates
         * à l'intérieur du dossier templates, on stocke les vues (les fichiers twig)
         * Chaque vue, va hériter d'une page parente (base.html.twig) situé à la racine du dossier
         *
         * Nomenclature : dans le dossier templates on crée un sous-dossier avec le même nom du controlleur
         * et dans ce dossier un fichier avec le même nom que la méthode qui appel la vue
         *
         * avec la méthode render(), on affiche un vue
         *
         * Request : une classe qui permet de récupérer les informations d'une requête HTTP
         *
         * Debug : 2 méthodes principales - dump (équivalent Symfony de var_dump) et dd (die() et dump())
         *
         * $request->request = $_POST
         * $request->query = $_GET
         * $request->files = $_FILES
         * $request->server = $_SERVER
         * $request->session = $_SESSION
         * ETC.
         *
         * render : 2 paramètres : lien vers la vue et les informations envoyé à la vue sous forme d'un array-associative -> la vue va récupérer la clé et afficher la valeur
         */

        $host = $request->headers->get('host');
        return $this->render('homepage/index.html.twig',[
           'myHost' => $host,
        ]);
    }

    /*
     * Pour créer des variables d'un URL, entourer le nom avec des accolades
     * la variable d'url se retrouve ogligatoirement dans les paramètres de la méthode
     */

    /**
     * @Route("/hello/{name}/{age}",name="homepage.hello")
     */
    public function hello(string $name, int $age):\Symfony\Component\HttpFoundation\Response
    {
        return $this->render('homepage/hello.html.twig',[
            'name' => $name,
            'age' => $age
        ]);
    }

}