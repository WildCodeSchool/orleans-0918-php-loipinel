<?php

namespace App\Controller;

use App\Entity\Finances;
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
     * @param Finances $finances
     * @return void
     */
    private function injectRealEstate(TaxBenefit $taxBenefit, Finances $finances) : void
    {
        $realEstate = new RealEstateProperty();
        $realEstate->setPurchasePrice($finances->getPurchasePrice());
        $realEstate->setSurfaceArea($finances->getSurfaceArea());

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
        $finances = $session->get('finances');

        $this->injectRealEstate($taxBenefit, $finances);
        $taxBenefit->setRentalPeriod($finances->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        return $this->render('result.html.twig', [
            'resultTaxBenefit' => $resultTaxBenefit,
            'finances' => $finances,
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
        $finances = $session->get('finances');

        $this->injectRealEstate($taxBenefit, $finances);
        $taxBenefit->setRentalPeriod($finances->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig', ['resultTaxBenefit' => $resultTaxBenefit,]);
        $lastName = $finances->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
