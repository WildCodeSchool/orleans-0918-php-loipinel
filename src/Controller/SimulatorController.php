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
    public function showSimulator(Request $request)
    {
        $simulator = new Simulator();

        $form = $this->createForm(
            SimulatorType::class,
            $simulator,
            ['method' => Request::METHOD_POST]
        );

        $form -> handleRequest ( $request );

        if ( $form -> isSubmitted () && $form -> isValid ()) {
            $data = $form -> getData ();
        }

        return $this->render(
            'Form/simulator.html.twig', [
                'simulator'=> $simulator,
                'form' => $form->createView(),
            ]
        );
    }
}
