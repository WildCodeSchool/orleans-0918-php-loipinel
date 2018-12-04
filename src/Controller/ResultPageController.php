<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\TaxBenefit;

class ResultPageController extends AbstractController
{
    /**
     * @Route("/resultat", name="result_page")
     */
    public function index(SessionInterface $session, TaxBenefit $taxBase, TaxBenefit $taxBenefit)
    {
        $simulator = $session->get('simulator');
        $base = $taxBase->taxBase($simulator->getPurchasePrice(), $simulator->getSurfaceArea());
        $result = $taxBenefit->taxBenefit($base, $simulator->getDuration());

        return $this->render('result.html.twig', [
            'result' => $result,
        ]);
    }
}
