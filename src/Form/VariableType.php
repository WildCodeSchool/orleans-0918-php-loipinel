<?php

namespace App\Form;

use App\Entity\Variable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maximumPricePerSquareMeter', IntegerType::class, ['label' => 'Prix maximum par mètre carré'])
            ->add('maximumTaxBase', IntegerType::class, ['label' => 'Base fiscale maximum'])
            ->add('rateFor6Years', NumberType::class, ['label' => 'Taux pour 6 ans'])
            ->add('rateFor9Years', NumberType::class, ['label' => 'Taux pour 9 ans'])
            ->add('rateFor12Years', NumberType::class, ['label' => 'Taux pour 12 ans'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Variable::class,
        ]);
    }
}
