<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaxBase;
use App\Service\CalculationTaxBenefit;

class ResultPageController extends AbstractController
{
    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session, TaxBase $taxBase, CalculationTaxBenefit $calculationTaxBenefit)
    {
        $simulator = $session->get('simulator');
        $base = $taxBase->taxBase($simulator->getPurchasePrice(), $simulator->getSurfaceArea());
        $result = $calculationTaxBenefit->taxBenefit($base, $simulator->getDuration());

        return $this->render('result.html.twig', [
            'result' => $result,
        ]);
    }
}
