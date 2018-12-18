<?php

namespace App\Controller;

use App\Entity\finance;
use App\Entity\RealEstateProperty;
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
     * @param finance $finance
     * @return void
     */
    private function injectRealEstate(TaxBenefit $taxBenefit, finance $finance) : void
    {
        $realEstate = new RealEstateProperty();
        $realEstate->setPurchasePrice($finance->getPurchasePrice());
        $realEstate->setSurfaceArea($finance->getSurfaceArea());

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
        $finance = $session->get('finance');

        $this->injectRealEstate($taxBenefit, $finance);
        $taxBenefit->setRentalPeriod($finance->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        return $this->render('result.html.twig', [
            'resultTaxBenefit' => $resultTaxBenefit,
            'finance' => $finance,
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
        $finance = $session->get('finance');

        $this->injectRealEstate($taxBenefit, $finance);
        $taxBenefit->setRentalPeriod($finance->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig', ['resultTaxBenefit' => $resultTaxBenefit,]);
        $lastName = $finance->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
