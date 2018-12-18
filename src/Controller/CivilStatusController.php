<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 22/11/18
 * Time: 21:42
 */

namespace App\Controller;

use App\Entity\CivilStatus;
use App\Entity\User;
use App\Form\CivilStatusType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CivilStatusController extends AbstractController
{
    /**
     * Show all row from category's entity
     * @Route("/etat_civil", name="civilStatus_show")
     * @param Request $request
     * @return Response A response instance
     */
    public function showCivilStatus(Request $request, SessionInterface $session)
    {
        $user = $this->getUser();
        $civilStatus = new CivilStatus();

        $form = $this->createForm(
            CivilStatusType::class,
            $civilStatus
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('civilStatus', $civilStatus);
            return $this->redirectToRoute('taxation_show');
        }

        return $this->render(
            'Form/civilStatus.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }
}
