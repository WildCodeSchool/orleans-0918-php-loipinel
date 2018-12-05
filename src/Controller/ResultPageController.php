<?php

namespace App\Controller;

use App\Entity\RealEstateProperty;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaxBenefit;

class ResultPageController extends AbstractController
{
    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session, TaxBenefit $taxBase)
    {
        $simulator = $session->get('simulator');

        $realEstate = new RealEstateProperty();
        $realEstate->setPurchasePrice($simulator->getPurchasePrice());
        $realEstate->setSurfaceArea($simulator->getSurfaceArea());

        $taxBase->setRealEstate($realEstate);

        $base = $taxBase->calculateTaxBase();

        return $this->render('result.html.twig', [
            'base' => $base,
        ]);
    }
}
