<?php

namespace App\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ResultPageController extends AbstractController
{
    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session)
    {
        $simulator = $session->get('simulator');
        return $this->render('result.html.twig', [
            'simulator' => $simulator,
        ]);
    }

    /**
     * @Route("/export-pdf", name="pdf_export")
     * @param Pdf $knpSnappyPdf
     * @param SessionInterface $session
     * @return PdfResponse
     */
    public function pdfAction(Pdf $knpSnappyPdf, SessionInterface $session)
    {
        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig');
        $simulator = $session->get('simulator');
        $lastName = $simulator->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
