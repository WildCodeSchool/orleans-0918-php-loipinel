<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 23/11/18
 * Time: 10:53
 */

namespace App\Form;

use App\Entity\Simulator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SimulatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName', TextType::class, [
            'label' => 'Prénom',
        ]);
        $builder->add('lastName', TextType::class, [
            'label' => 'Nom',
        ]);
        $builder->add('address', TextType::class, [
            'label' => 'Adresse',
        ]);
        $builder->add('acquisitionDate', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date d\'acquisition',
        ]);
        $builder->add('zipCode', TextType::class, [
            'label' => 'Code Postal',
        ]);
        $builder->add('city', ChoiceType::class, [
            'label' => 'Ville',
        ]);
        $builder->get('city')->resetViewTransformers();
        $builder->add('zone', TextType::class);
        $builder->add('duration', ChoiceType::class, [
            'label' => 'Durée',
            'choices' => [
                '6 ans' => 6,
                '9 ans' => 9,
                '12 ans' => 12,
            ],
            'multiple' => false,
            'expanded' => true,
        ]);
        $builder->add('surfaceArea', NumberType::class, [
            'label' => 'Surface en M2',
            'scale' => 2,
        ]);
        $builder->add('purchasePrice', MoneyType::class, [
            'label' => 'Prix d\'achat',
            'grouping' => true,
        ]);
        $builder->add('notaryFees', MoneyType::class, [
            'label' => 'Frais de notaire',
            'grouping' => true,
        ]);
        $builder->add('otherFeesAcquisition', MoneyType::class, [
            'label' => 'Autres frais d\'acquisition',
            'grouping' => true,
        ]);
        $builder->add('totalAmountAcquisition', MoneyType::class, [
            'label' => 'Montant total de l\'acquisition',
            'grouping' => true,
        ]);
        $builder->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Simulator::class,
        ]);
    }
}
