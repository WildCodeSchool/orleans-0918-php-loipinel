<?php

namespace App\Controller;

use App\Entity\RealEstateProperty;
use App\Entity\Simulator;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaxBenefit;

class ResultPageController extends AbstractController
{
    /**
     * @param TaxBenefit $taxBase
     * @param Simulator $simulator
     * @return float
     */
    private function baseCalculation(TaxBenefit $taxBase, Simulator $simulator) :float
    {
        $realEstate = new RealEstateProperty();
        $realEstate->setPurchasePrice($simulator->getPurchasePrice());
        $realEstate->setSurfaceArea($simulator->getSurfaceArea());

        $taxBase->setRealEstate($realEstate);

        return $taxBase->calculateTaxBase();
    }

    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session, TaxBenefit $taxBase)
    {
        $user = $this->getUser();
        $simulator = $session->get('simulator');

        $base = $this->baseCalculation($taxBase, $simulator);

        return $this->render('result.html.twig', [
            'base' => $base,
            'simulator' => $simulator,
            'user' => $user,
        ]);
    }

    /**
     * @Route("/export-pdf", name="pdf_export")
     * @param Pdf $knpSnappyPdf
     * @param SessionInterface $session
     * @return PdfResponse
     */
    public function pdfAction(Pdf $knpSnappyPdf, SessionInterface $session, TaxBenefit $taxBase)
    {
        $simulator = $session->get('simulator');

        $base = $this->baseCalculation($taxBase, $simulator);

        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig', ['base' => $base,]);
        $lastName = $simulator->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
