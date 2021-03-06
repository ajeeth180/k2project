<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 31-5-2018
 * Time: 10:10
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'label' => "Gebruikersnaam"
            ))
            ->add('password', RepeatedType::class, array(
                'type'=> PasswordType::class,
                'first_options' => array('label'=>"Wachtwoord"),
                'second_options' => array('label'=>"Herhaal Wachtwoord")
            ))
            ->add('firstname')
            ->add('preprovision')
            ->add('lastname')
            ->add('dateofbirth', DateType::class, array(
                'html5' => false,
                'years' => range(1900, 2018)
            ));
    }
}