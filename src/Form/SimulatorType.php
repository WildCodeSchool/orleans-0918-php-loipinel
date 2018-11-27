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
        $builder->add('firstName', TextType::class);
        $builder->add('lastName', TextType::class);
        $builder->add('address', TextType::class);
        $builder->add('zipCode', IntegerType::class);
        $builder->add('city', TextType::class);
        $builder->add('zone', ChoiceType::class, array(
            'choices' => array(
                "A" => "a",
                "A bis" => "a bis",
                "B1"  => "b1" ,
                "B2"  => "b2" ,
                "C"  => "c" ,
            )));
        $builder->add('acquisitionDate', DateType::class);
        $builder->add('duration', ChoiceType::class, array(
            'choices' => array(
                6 => 6,
                9 => 9,
                12 =>12,
            )));
        $builder->add('purchasePrice', MoneyType::class);
        $builder->add('notaryFees', MoneyType::class);
        $builder->add('otherFeesAcquisition', MoneyType::class);
        $builder->add('totalAmountAcquisition', MoneyType::class);
        $builder-> getForm();
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Simulator::class,
        ]);
    }
}
