<?php

namespace App\Controller;

use App\Entity\finance;
use App\Entity\RealEstateProperty;
use App\Service\ApiAddressRequest;
use App\Service\DataPinelJson;
use DateTime;
use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use phpDocumentor\Reflection\Types\String_;
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
     * @param Finance $finance
     * @return void
     */
    private function injectRealEstate(TaxBenefit $taxBenefit, Finance $finance) : void
    {
        $realEstate = new RealEstateProperty();
        $realEstate->setPurchasePrice($finance->getPurchasePrice());
        $realEstate->setSurfaceArea($finance->getSurfaceArea());

        $taxBenefit->setRealEstate($realEstate);
    }

    /**
     * @param SessionInterface $session
     * @param TaxBenefit $taxBenefit
     * @param DataPinelJson $dataPinelJson
     * @param ApiAddressRequest $apiAddressRequest
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @Route("/resultat", name="result_page")
     */
    public function index(
        SessionInterface $session,
        TaxBenefit $taxBenefit,
        DataPinelJson $dataPinelJson,
        ApiAddressRequest $apiAddressRequest
    ) {
        $user = $this->getUser();
        $finance = $session->get('finance');

        $this->injectRealEstate($taxBenefit, $finance);
        $taxBenefit->setRentalPeriod($finance->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        $acquisitionDate = date_format($finance->getAcquisitionDate(), 'Y-m-d H:i:s');
        $area = $dataPinelJson->getPinelArea($acquisitionDate, $finance->getCity());

        $city = $apiAddressRequest->getCityApi($finance->getZipCode(), $finance->getCity());


        return $this->render('result.html.twig', [
            'resultTaxBenefit' => $resultTaxBenefit,
            'taxBenefit' => $taxBenefit,
            'finance' => $finance,
            'user' => $user,
            'area' => $area,
            'city' => $city
        ]);
    }

    /**
     * @Route("/export-pdf", name="pdf_export")
     * @param Pdf $knpSnappyPdf
     * @param SessionInterface $session
     * @param TaxBenefit $taxBenefit
     * @param DataPinelJson $dataPinelJson
     * @param ApiAddressRequest $apiAddressRequest
     * @return PdfResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function pdfAction(
        Pdf $knpSnappyPdf,
        SessionInterface $session,
        TaxBenefit $taxBenefit,
        DataPinelJson $dataPinelJson,
        ApiAddressRequest $apiAddressRequest
    ) {
        $finance = $session->get('finance');
        $civilStatus = $session->get('civilStatus');

        $this->injectRealEstate($taxBenefit, $finance);
        $taxBenefit->setRentalPeriod($finance->getDuration());
        $resultTaxBenefit = $taxBenefit->calculateTaxBenefit();

        $acquisitionDate = date_format($finance->getAcquisitionDate(), 'Y-m-d H:i:s');
        $area = $dataPinelJson->getPinelArea($acquisitionDate, $finance->getCity());

        $city = $apiAddressRequest->getCityApi($finance->getZipCode(), $finance->getCity());

        /* creating the pdf from html page */
        $html = $this->renderView('resume.html.twig', [
            'resultTaxBenefit' => $resultTaxBenefit,
            'area' => $area,
            'city' => $city
        ]);
        $lastName = $civilStatus->getLastName();

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html, ['user-style-sheet' => ['./build/app.css',],]),
            $lastName . '_' . date("d-m-Y") . '.pdf'
        );
    }
}
