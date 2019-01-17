<?php

namespace App\Form;

use App\Entity\Variable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JsonFileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('jsonFile', FileType::class, ['label' => 'Téléversez le fichier Pinel au format json'])
            ->add('changePassword', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr'  => [
                    'class' => 'btn btn-primary text-align-center',
                ],])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Variable::class,
        ]);
    }
}
