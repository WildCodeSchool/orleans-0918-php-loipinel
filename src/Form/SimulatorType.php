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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
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
        $builder->add('zipCode', IntegerType::class, [
            'label' => 'Code Postal',
        ]);
        $builder->add('city', TextType::class, [
            'label' => 'Ville',
        ]);
        $builder->add('zone', ChoiceType::class, [
                'choices' => [
                    "A" => "a",
                    "A bis" => "a bis",
                    "B1" => "b1",
                    "B2" => "b2",
                    "C" => "c",
                ],
            ]);
        $builder->add('acquisitionDate', DateType::class, [
            'label' => 'Date d\'acquisition',
            ]);
        $builder->add('duration', ChoiceType::class, [
                'label' => 'Durée',
                'choices' => [
                    6 => 6,
                    9 => 9,
                    12 => 12,
                ]]);
        $builder->add('surfaceArea', IntegerType::class, [
            'label' => 'Surface en M2',
        ]);
        $builder->add('purchasePrice', MoneyType::class, [
            'label' => 'Prix d\'achat',
        ]);
        $builder->add('notaryFees', MoneyType::class, [
            'label' => 'Frais de notaire',
        ]);
        $builder->add('otherFeesAcquisition', MoneyType::class, [
            'label' => 'Autres frais d\'acquisition',
        ]);
        $builder->add('totalAmountAcquisition', MoneyType::class, [
            'label' => 'Montant total de l\'acquisition',
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
