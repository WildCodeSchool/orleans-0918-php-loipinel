<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 17/12/18
 * Time: 14:35
 */

namespace App\Controller;

use App\Entity\Taxation;
use App\Form\TaxationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class TaxationController extends AbstractController
{
    /**
     * Show all row from category's entity
     * @Route("/fiscalite", name="taxation_show")
     * @param Request $request
     * @return Response A response instance
     */
    public function showTaxation(Request $request, SessionInterface $session)
    {
        $user = $this->getUser();
        $taxation = new Taxation();

        $form = $this->createForm(
            TaxationType::class,
            $taxation
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('taxation', $taxation);
            return $this->redirectToRoute('finances');
        }

        return $this->render(
            'Form/taxation.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }
}
