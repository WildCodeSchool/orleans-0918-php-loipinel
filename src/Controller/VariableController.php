<?php

namespace App\Controller;

use App\Entity\Variable;
use App\Entity\UploadJson;
use App\Form\JsonFileType;
use App\Form\VariableType;
use App\Repository\VariableRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/variable")
 * @IsGranted("ROLE_ADMIN")
 */
class VariableController extends AbstractController
{
    /**
     * @Route("/", name="variable_index", methods="GET|POST")
     */
    public function index(Request $request, VariableRepository $variableRepository): Response
    {
        $uploadJson = new UploadJson();
        $formJson = $this->createForm(JsonFileType::class, $uploadJson);
        $formJson->handleRequest($request);

        if ($formJson->isSubmitted() && $formJson->isValid()) {
            $file = $uploadJson->getJsonFile();
            $fileName = 'pinel.json';

            try {
                $file->move(
                    $this->getParameter('jsonFile_directory'),
                    $fileName
                );
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $uploadJson->setJsonFile($fileName);
        }
            return $this->render('variable/index.html.twig', [
                'form' => $formJson->createView(),
                'variables' => $variableRepository->findAll()
            ]);
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
