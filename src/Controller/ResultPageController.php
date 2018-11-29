<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ResultPageController extends AbstractController
{
    /**
     * @Route("/resultat", name="result_page")
     */
    public function index()
    {
        return $this->render('result.html.twig', [
            'controller_name' => 'ResultPageController',
        ]);
    }
}
