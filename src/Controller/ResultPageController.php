<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResultPageController extends AbstractController
{
    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session)
    {
        $user = $this->getUser();
        $simulator = $session->get('simulator');
        return $this->render('result.html.twig', [
            'simulator' => $simulator,
            'user' => $user,
        ]);
    }
}
