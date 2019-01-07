<?php

namespace App\Controller;

use App\Entity\Variable;
use App\Form\VariableType;
use App\Repository\VariableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/variable")
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
     * @Route("/new", name="variable_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $variable = new Variable();
        $form = $this->createForm(VariableType::class, $variable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($variable);
            $em->flush();

            return $this->redirectToRoute('variable_index');
        }

        return $this->render('variable/new.html.twig', [
            'variable' => $variable,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="variable_show", methods="GET")
     */
    public function show(Variable $variable): Response
    {
        return $this->render('variable/show.html.twig', ['variable' => $variable]);
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

    /**
     * @Route("/{id}", name="variable_delete", methods="DELETE")
     */
    public function delete(Request $request, Variable $variable): Response
    {
        if ($this->isCsrfTokenValid('delete'.$variable->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($variable);
            $em->flush();
        }

        return $this->redirectToRoute('variable_index');
    }
}
