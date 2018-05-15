<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\User;
use App\Repository\ArticleRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index(ArticleRepository $articleRepository) {
        $articles = $articleRepository->getNewestArticlesWithLimit(3);
        return $this->render("default/index.html.twig", ["articles" => $articles]);
    }

    /**
     * @Route("/contact")
     */
    public function contact() {
        return $this->render("default/contact.html", []);
    }

    /**
     * @Route("/register", methods="GET|POST")
     */
    public function register(Request $request) {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_show/'.$user->getId());
        }
        return $this->render("security/register.html.twig", [
            "user" => $user,
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/login", methods="GET|POST")
     */
    public function login() {
        return $this->render("security/login.html.twig", []);
    }
}