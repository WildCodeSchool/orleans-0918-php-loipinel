<?php

namespace App\Controller;

use App\Entity\RealEstateProperty;
use App\Entity\Simulator;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaxBenefit;

/**
 * @IsGranted("ROLE_USER")
 */
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
     * @param SessionInterface $session
     * @param TaxBenefit $taxBenefit
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session, TaxBenefit $taxBenefit)
    {
        $user = $this->getUser();
        $simulator = $session->get('simulator');

        $this->injectRealEstate($taxBenefit, $simulator);
        $taxBenefit->setRentalPeriod($simulator->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        return $this->render('result.html.twig', [
            'resultTaxBenefit' => $resultTaxBenefit,
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
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig', ['resultTaxBenefit' => $resultTaxBenefit,]);
        $lastName = $simulator->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
