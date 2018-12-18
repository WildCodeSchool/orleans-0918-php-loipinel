<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 22/11/18
 * Time: 21:42
 */

namespace App\Controller;

use App\Entity\Finance;
use App\Entity\Simulator;
use App\Entity\User;
use App\Form\FinanceType;
use App\Form\SimulatorType;
use App\Service\DataJson;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class SimulatorController extends AbstractController
{
    const INELLIGIBLE_AREA = 'C';

    /**
     * @Route("/finances", name="finances")
     * @param Request $request
     * @param SessionInterface $session
     * @return Response
     */
    public function showFinance(Request $request, SessionInterface $session): Response
    {
        $user = $this->getUser();
        $finance = new Finance();

        $form = $this->createForm(
            FinanceType::class,
            $finance
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('finance', $finance);
            return $this->redirectToRoute('result_page');
        }

        return $this->render(
            'Form/finance.html.twig',
            [
                'form' => $form->createView(),
                'user' => $user,
            ]
        );
    }

    /**
     * @Route("/area/{date}/{cityCode}")
     * @param string $cityCode
     * @param string $date
     * @param DataJson $service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getArea(string $cityCode, string $date, DataJson $service): Response
    {
        $res = date_parse($date);
        $selectYear = $res['year'];
        $result = $service->jsonReading();
        if (key_exists($selectYear, $result['years'])) {
            $inseeCodes = $result['years'][$selectYear]['insee'];
            if (key_exists($cityCode, $inseeCodes)) {
                $area = $inseeCodes[$cityCode];
            } else {
                $area = self::INELLIGIBLE_AREA;
            }
        } else {
            $area = 'Données indisponibles pour l\'année renseignée';
        }
        return $this->json($area);
    }
}
