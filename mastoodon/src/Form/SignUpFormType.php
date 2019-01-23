<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class SignUpFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('surname', null, array('label' => false))
            ->add('firstname', null, array('label' => false))
            ->add('email', null, array('label' => false))
            ->add('password', PasswordType::class, array('label' => false))
            ->add('confirmpassword', PasswordType::class, array('label' => false))
            // ->add('ballotsNumber')
            // ->add('lastClaim')
            // ->add('isAdmin')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
