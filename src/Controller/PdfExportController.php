<?php

namespace App\Controller;

use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class PdfExportController extends AbstractController
{
    /**
     * @Route("/export-pdf", name="pdf_export")
     * @return PdfResponse
     */
    public function pdfAction(Pdf $knpSnappyPdf, SessionInterface $session)
    {
        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig');
        $simulator = $session->get('simulator');
        $lastName = $simulator->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, array(
                'encoding' => 'utf-8',
            )),
            $lastName . '-' . date("d_m_Y") . '.pdf'
        );
    }
}
