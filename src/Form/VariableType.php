<?php

namespace App\Form;

use App\Entity\Variable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maximumPricePerSquareMeter')
            ->add('maximumTaxBase')
            ->add('rateFor6Years')
            ->add('rateFor9Years')
            ->add('rateFor12Years')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Variable::class,
        ]);
    }
}
