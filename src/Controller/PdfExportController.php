<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;

class PdfExportController extends AbstractController
{
    /**
     * @Route("/export-pdf", name="pdf_export")
     * @param SessionInterface $session
     * @return PdfResponse
     */
    public function pdfAction(SessionInterface $session)
    {
        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig');

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            'file.pdf'
        );
    }
}
