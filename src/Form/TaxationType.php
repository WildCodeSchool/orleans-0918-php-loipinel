<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 17/12/18
 * Time: 12:08
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class TaxationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
        $builder->add('numberOfTaxShares', TextType::class, [
        'label' => "Nombre de parts fiscales",
        ]);
        $builder->add('salaryDeclared', MoneyType::class, [
            'label' => "Salaire déclaré",
        ]);
        $builder->add('landIncomes', MoneyType::class, [
            'label' => "Revenus fonciers",
        ]);

        $builder->add('bic', MoneyType::class, [
            'label' => "B.I.C.",
            'help' => "Bénéfices Industriels et Commerciaux"
        ]);
        $builder->add('bnc', MoneyType::class, [
            'label' => "B.N.C.",
            'help' => "Bénéfices Non Commerciaux",
        ]);
        $builder->add('ba', MoneyType::class, [
            'label' => "B.A.",
            'help' => "Bénéfices Agricoles",
        ]);
        $builder->add('incomeTax', MoneyType::class, [
            'label' => "Impôt sur le revenu",
        ]);
    }
}
