<?php

namespace App\Controller;

use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChangePasswordType;

/**
 * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_USER')")
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

                $this->addFlash('success', 'Votre mot de passe a bien été enregistré');

                return $this->redirectToRoute('simulator_show');
            } else {
                $this->addFlash('danger', 'Mot de passe actuel incorrect');
            }
        }

        return $this->render('security/changePassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @isGranted("ROLE_ADMIN")
     * @Route("/reset-password/{user}", name="user_reset_password")
     */
    public function reset(User $user, Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(ChangePasswordType::class)->remove('password');

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $newPlainPassword = $data['newPassword'];
            $newEncodedPassword = $encoder->encodePassword($user, $newPlainPassword);
            $user->setPassword($newEncodedPassword);
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Votre mot de passe a bien été enregistré');

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('security/resetPassword.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
