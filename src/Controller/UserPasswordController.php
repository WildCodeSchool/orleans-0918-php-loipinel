<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UpdatePasswordType;

class UserPasswordController extends AbstractController
{
    /**
     * @Route("/edit-password", name="password-edit")
     */
    public function editAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(UpdatePasswordType::class, $user);
        $updatePassword = new UpdatePasswordType();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $encoded = $encoder->encodePassword($user, $data['password']);

            // Si l'ancien mot de passe est bon
            if ($encoder->isPasswordValid($user, $encoder)) {
                $newEncodedPassword = $encoded;

                $user->setPassword($newEncodedPassword);

                $em->persist($user);
                $em->flush();

                echo ('nice');

                return $this->redirectToRoute('simulator_show');
            } else {
                echo('et c\'est un échec');
            }
        }

        return $this->render('security/passwordUpdate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
