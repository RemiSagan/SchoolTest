<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Study;
use App\Entity\Choose;
use App\Entity\Specialty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChooseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('user', EntityType::class, [
            //     'class' => User::class,
            //     'choice_label' => 'firstname',
            // ])
            ->add('specialties', EntityType::class, [
                'class' => Specialty::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('study', EntityType::class, [
                'class' => Study::class,
                'choice_label' => 'name',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Choose::class,
        ]);
    }
}
