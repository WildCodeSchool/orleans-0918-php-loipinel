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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class FiscalityType extends AbstractType
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
    }
}
