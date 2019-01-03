<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 22/11/18
 * Time: 21:42
 */

namespace App\Controller;

use App\Entity\Simulator;
use App\Entity\User;
use App\Form\SimulatorType;
use App\Service\ApiAdressRequest;
use App\Service\DataJson;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SimulatorController extends AbstractController
{
    const INELLIGIBLE_AREA = 'C';

    /**
     * Show all row from category's entity
     * @Route("/simulator", name="simulator_show")
     * @param Request $request
     * @param SessionInterface $session
     * @param ApiAdressRequest $service
     * @return Response A response instance
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function showSimulator(Request $request, SessionInterface $session, ApiAdressRequest $service): Response
    {
        $user = $this->getUser();
        $simulator = new Simulator();

        $form = $this->createForm(
            SimulatorType::class,
            $simulator
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $city = $service->getCity($simulator);
            $simulator->setCity($city);
            $session->set('simulator', $simulator);

            return $this->redirectToRoute('result_page');
        }

        return $this->render(
            'Form/simulator.html.twig',
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
