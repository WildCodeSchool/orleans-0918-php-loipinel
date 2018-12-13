<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChangePasswordType;

/**
 * @IsGranted("ROLE_USER")
 */
class UserPasswordController extends AbstractController
{
    /**
     * @Route("/change-password", name="password-change")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function change(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $formPassword = $data['password'];
            // Si l'ancien mot de passe est bon
            if ($encoder->isPasswordValid($user, $formPassword)) {
                $newPlainPassword = $data['newPassword'];
                $newEncodedPassword = $encoder->encodePassword($user, $newPlainPassword);
                $user->setPassword($newEncodedPassword);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('simulator_show');
            } else {
                $this->addFlash('danger', 'Mot de passe actuel incorrect');
            }
        }

        return $this->render('security/changePassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
