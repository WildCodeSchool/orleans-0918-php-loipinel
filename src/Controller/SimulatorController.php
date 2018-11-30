<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 22/11/18
 * Time: 21:42
 */

namespace App\Controller;

use App\Entity\Simulator;
use App\Form\SimulatorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SimulatorController extends AbstractController
{
    /**
     * Show all row from category's entity
     *
     * @Route("/simulator", name="simulator_show")
     * @param Request $request
     * @return Response A response instance
     */
    public function showSimulator(Request $request, SessionInterface $session)
    {
        $simulator = new Simulator();

        $form = $this->createForm(
            SimulatorType::class,
            $simulator
        );

        $form -> handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('simulator', $simulator);
            return $this->redirectToRoute('result_page');
        }

        return $this->render(
            'Form/simulator.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
