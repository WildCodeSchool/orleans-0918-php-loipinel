<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 22/11/18
 * Time: 21:42
 */

namespace App\Controller;

use App\Entity\Finances;
use App\Entity\Simulator;
use App\Entity\User;
use App\Form\FinancesType;
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
    public function showFinances(Request $request, SessionInterface $session): Response
    {
        $user = $this->getUser();
        $finances = new Finances();

        $form = $this->createForm(
            FinancesType::class,
            $finances
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session->set('finances', $finances);
            return $this->redirectToRoute('result_page');
        }

        return $this->render(
            'Form/finances.html.twig',
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
