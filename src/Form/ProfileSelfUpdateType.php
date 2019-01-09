<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileSelfUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newEmail', EmailType::class, [
                'required' => false,
                'label' => 'Nouvel Email',
            ])
            ->add('newLastName', TextType::class, [
                'required' => false,
                'label' => 'Nouveau nom',
            ])
            ->add('newFirstName', TextType::class, [
                'required' => false,
                'label' => 'Nouveau prénom',
            ])
            ->add('changePassword', SubmitType::class, [
                'label' => 'Editer mes informations',
                'attr'  => [
                    'class' => 'btn btn-primary text-align-center',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
