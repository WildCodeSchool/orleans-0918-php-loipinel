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
     * @param TaxBenefit $taxBenefit
     * @param Simulator $simulator
     * @return void
     */
    private function injectRealEstate(TaxBenefit $taxBenefit, Simulator $simulator) : void
    {
        $realEstate = new RealEstateProperty();
        $realEstate->setPurchasePrice($simulator->getPurchasePrice());
        $realEstate->setSurfaceArea($simulator->getSurfaceArea());

        $taxBenefit->setRealEstate($realEstate);
    }

    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session, TaxBenefit $taxBenefit)
    {
        $user = $this->getUser();
        $simulator = $session->get('simulator');

        $this->injectRealEstate($taxBenefit, $simulator);
        $taxBenefit->setRentalPeriod($simulator->getDuration());
        $taxBenefit->calculateTaxBenefit();

        return $this->render('result.html.twig', [
            'taxBenefit' => $taxBenefit,
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
    public function pdfAction(Pdf $knpSnappyPdf, SessionInterface $session, TaxBenefit $taxBenefit)
    {
        $simulator = $session->get('simulator');

        $this->injectRealEstate($taxBenefit, $simulator);
        $taxBenefit->setRentalPeriod($simulator->getDuration());
        $taxBenefit->calculateTaxBenefit();

        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig', ['taxBenefit' => $taxBenefit,]);
        $lastName = $simulator->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
