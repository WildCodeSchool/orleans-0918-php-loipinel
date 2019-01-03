<?php

namespace App\Form;

use App\Entity\Finance;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zipCode', TextType::class, [
            'label' => 'Code Postal',
        ]);
        $builder->add('city', ChoiceType::class, [
            'label' => 'Ville',
        ]);
        $builder->get('city')->resetViewTransformers();
        $builder->add('zone', TextType::class, [
            'disabled' => 'disabled',
        ]);
        $builder->add('acquisitionDate', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date d\'acquisition',
        ]);
        $builder->add('duration', ChoiceType::class, [
            'label' => 'Durée',
            'choices' => $options['data']->getDurations(),
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
        $builder->add('parkingAmount', MoneyType::class, [
            'label' => 'Montant du parking',
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
        $builder->add('monthlyRent', MoneyType::class, [
            'label' => 'Loyer mensuel',
            'grouping' => true,
        ]);
        $builder->add('borrowedAmount', MoneyType::class, [
            'label' => "Montant emprunté",
            'grouping' => true,
        ]);
        $builder->add('inflow', MoneyType::class, [
            'label' => 'Apport',
            'grouping' => true,
        ]);
        $builder->add('fundingPeriod', NumberType::class, [
            'label' => "Durée du financement",
        ]);
        $builder->add('adi', NumberType::class, [
            'label' => "A.D.I.",
        ]);
        $builder->add('managementFees', NumberType::class, [
            'label' => "Frais de gestion",
        ]);
        $builder->add('rentalFee', NumberType::class, [
            'label' => "Honoraires de location",
        ]);
        $builder->add('rentInsurance', NumberType::class, [
            'label' => "Assurance du loyer",
        ]);
        $builder->add('coownershipCharges', NumberType::class, [
            'label' => "Charges de copropriété",
        ]);
        $builder->add('propertyTax', MoneyType::class, [
            'label' => "Taxe foncière",
        ]);
        $builder->getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Finance::class,
        ]);
    }
}
