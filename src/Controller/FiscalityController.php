<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 17/12/18
 * Time: 14:35
 */

namespace App\Controller;

use App\Entity\Fiscality;
use App\Form\FiscalityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FiscalityController extends AbstractController
{
    /**
     * Show all row from category's entity
     * @Route("/fiscality", name="fiscality_show")
     * @param Request $request
     * @return Response A response instance
     */
    public function showFiscality(Request $request, SessionInterface $session)
    {
        $user = $this->getUser();
        $fiscality = new Fiscality();

        $form = $this->createForm(
            FiscalityType::class,
            $fiscality
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('fiscality', $fiscality);
            return $this->redirectToRoute('finances');
        }

        return $this->render(
            'Form/fiscality.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }
}
