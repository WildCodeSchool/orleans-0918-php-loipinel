<?php
/**
 * Created by PhpStorm.
 * User: jovanela
 * Date: 17/12/18
 * Time: 12:08
 */

namespace App\Form;

use App\Entity\Taxation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class TaxationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('familySituation', ChoiceType::class, [
            'label' => 'Situation familiale',
            'choices' => Taxation::getFamilySituations(),
        ]);
        $builder->add('numberOfChildren', IntegerType::class, [
            'label' => "Nombre d'enfants",
            'attr' => [
                'min' => 0,
            ],
        ]);
        $builder->add('numberOfTaxShares', NumberType::class, [
            'label' => "Nombre de parts fiscales",
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,
        ]);

        $builder->add('salaryDeclared', MoneyType::class, [
            'label' => "Salaire déclaré",
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,
        ]);
        $builder->add('landIncomes', MoneyType::class, [
            'label' => "Revenus fonciers",
            'data' => 0,
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,

        ]);

        $builder->add('bic', MoneyType::class, [
            'label' => "B.I.C.",
            'help' => "Bénéfices Industriels et Commerciaux",
            'required' => false,
            'data' => 0,
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,
        ]);
        $builder->add('bnc', MoneyType::class, [
            'label' => "B.N.C.",
            'help' => "Bénéfices Non Commerciaux",
            'required' => false,
            'data' => 0,
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,
        ]);
        $builder->add('ba', MoneyType::class, [
            'label' => "B.A.",
            'help' => "Bénéfices Agricoles",
            'required' => false,
            'data' => 0,
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,
        ]);
        $builder->add('incomeTax', MoneyType::class, [
            'label' => "Impôt sur le revenu",
            'invalid_message' => 'Ce champ ne peut ne peut contenir que des chiffres' ,
        ]);
    }
}
