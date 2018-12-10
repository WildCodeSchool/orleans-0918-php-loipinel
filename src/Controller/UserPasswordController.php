<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserPasswordController extends AbstractController
{
    /**
     * @Route("/edit-password", name="password-edit")
     */
    public function redirectToPasswordUpdatePage()
    {
        return $this->render('security/passwordUpdate.html.twig', [
            'controller_name' => 'UserPasswordController',
        ]);
    }
}
