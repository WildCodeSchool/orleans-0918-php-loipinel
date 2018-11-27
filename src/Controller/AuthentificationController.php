<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthentificationController extends AbstractController
{
    /**
     * @Route("/", name="authentification")
     */
    public function index()
    {
        return $this->render('authentification.html.twig', [
            'controller_name' => 'AuthentificationController',
        ]);
    }
}
