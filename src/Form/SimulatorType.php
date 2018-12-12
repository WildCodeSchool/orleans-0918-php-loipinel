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
        $builder->add('civility', ChoiceType::class, [
            'choices' => [
                "Monsieur" => "Monsieur",
                "Madame" => "Madame",
                "M./Mme" => "M./Mme",
                "M./M." => "M./M.",
                "Mme/Mme" => "Mme/Mme",
            ],
        ]);
        $builder->add('firstName', TextType::class, [
            'label' => 'Prénom',
        ]);
        $builder->add('lastName', TextType::class, [
            'label' => 'Nom',
        ]);
        $builder->add('customerAddress', TextType::class, [
            'label' => 'Adresse',
        ]);
        $builder->add('customerZipCode', TextType::class, [
            'label' => 'Code Postal',
        ]);
        $builder->add('customerCity', TextType::class, [
            'label' => 'Ville',
        ]);


        $builder->add('familySituation', ChoiceType::class, [
            'label' => 'Situation familiale',
            'choices' => [
                "célibataire" => "célibataire",
                "en concubinage" => "en concubinage",
                "mariés" => "mariés",
                "pacsés" => "pacsés",
                "divorcé(e)" => "divorcé(e)",
            ],
        ]);
        $builder->add('numberOfChildren', TextType::class, [
            'label' => "Nombre d'enfants",
        ]);
        $builder->add('numberOfTaxShares', TextType::class, [
            'label' => "Nombre de parts fiscales",
        ]);
        $builder->add('salaryDeclared', TextType::class, [
            'label' => "Salaire déclaré",
        ]);
        $builder->add('landIncomes', TextType::class, [
            'label' => "Revenus fonciers",
        ]);
        $builder->add('numberOfTaxShares', TextType::class, [
            'label' => "Nombre de parts fiscales",
        ]);
        $builder->add('bic', TextType::class, [
            'label' => "B.I.C.",
        ]);
        $builder->add('bnc', TextType::class, [
            'label' => "B.N.C.",
        ]);
        $builder->add('ba', TextType::class, [
            'label' => "B.A.",
        ]);
        $builder->add('incomeTax', TextType::class, [
            'label' => "Impôt sur le revenu",
        ]);

        $builder->add('zipCode', TextType::class, [
            'label' => 'Code Postal',
        ]);
        $builder->add('city', ChoiceType::class, [
            'label' => 'Ville',
        ]);
        $builder->get('city')->resetViewTransformers();
        $builder->add('zone', ChoiceType::class, [
            'choices' => [
                "A" => "A",
                "A bis" => "A bis",
                "B1" => "B1",
                "B2" => "B2",
                "C" => "B",
            ],
        ]);
        $builder->add('acquisitionDate', DateType::class, [
            'widget' => 'single_text',
            'label' => 'Date d\'acquisition',
        ]);
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
            'data_class' => Simulator::class,
        ]);
    }
}
