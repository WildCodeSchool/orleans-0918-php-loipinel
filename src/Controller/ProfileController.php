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
        $form = $this->createForm(ProfileSelfUpdateType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formEmail = $form->get('email')->getData();
            $formLastName = $form->get('lastName')->getData();
            $formFirstName = $form->get('firstName')->getData();

            if (isset($formEmail)) {
                $user->setEmail($formEmail);
                $em->persist($user);
                $em->flush();
            }

            if (isset($formLastName)) {
                $user->setLastName($formLastName);
                $em->persist($user);
                $em->flush();
            }

            if (isset($formFirstName)) {
                $user->setFirstName($formFirstName);
                $em->persist($user);
                $em->flush();
            }
            $this->addFlash('success', 'Vos informations ont bien été modifiées');

            return $this->redirectToRoute('civilStatus_show');
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
