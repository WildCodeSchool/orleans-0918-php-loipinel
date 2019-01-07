<?php

namespace App\Controller;

use App\Entity\Variable;
use App\Form\VariableType;
use App\Repository\VariableRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/variable")
 * @IsGranted("ROLE_ADMIN")
 */
class VariableController extends AbstractController
{
    /**
     * @Route("/", name="variable_index", methods="GET")
     */
    public function index(VariableRepository $variableRepository): Response
    {
        return $this->render('variable/index.html.twig', ['variables' => $variableRepository->findAll()]);
    }

    /**
     * @Route("/{id}/edit", name="variable_edit", methods="GET|POST")
     */
    public function edit(Request $request, Variable $variable): Response
    {
        $form = $this->createForm(VariableType::class, $variable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('variable_index', ['id' => $variable->getId()]);
        }

        return $this->render('variable/edit.html.twig', [
            'variable' => $variable,
            'form' => $form->createView(),
        ]);
    }
}
