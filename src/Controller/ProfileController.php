<?php

namespace App\Controller;

use App\Form\ProfileSelfUpdateType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="self-update-profile")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function updateProfileInfos(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ProfileSelfUpdateType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if (isset($data['newEmail'])) {
                $newEmail = $data['newEmail'];
                $user->setEmail($newEmail);
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre adresse mail a bien été modifiée');

                return $this->redirectToRoute('simulator_show');
            } else {
                $this->addFlash('danger', 'Votre adresse mail est incorrect');
            }

            if (isset($data['newFirstName'])) {
                $newFirstName = $data['newFirstName'];
                $user->setEmail($newFirstName);
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre prénom a bien été modifiée');

                return $this->redirectToRoute('simulator_show');
            } else {
                $this->addFlash('danger', 'Votre prénom est incorrect');
            }

            if (isset($data['newLastName'])) {
                $newLastName = $data['newLastName'];
                $user->setEmail($newLastName);
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Votre nom a bien été modifiée');

                return $this->redirectToRoute('simulator_show');
            } else {
                $this->addFlash('danger', 'Votre nom est incorrect');
            }
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
