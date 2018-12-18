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

class CivilStatusType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('civility', ChoiceType::class, [
            'label' => 'Civilité',
            'choices' => $options['data']->getCivilities(),
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
    }
}
