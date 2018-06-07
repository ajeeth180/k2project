<?php
/**
 * Created by PhpStorm.
 * User: Amaru Signore
 * Date: 5-6-2018
 * Time: 14:11
 */

namespace AppBundle\Form;
use AppBundle\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('training', EntityType::class,
                array('class' => 'AppBundle:Training',
                    'choice_label' => 'description',))
            ->add('user', EntityType::class,
                array('class' => 'AppBundle:User',
                    'choice_label' => 'firstname',))
            ->add('time', TimeType::class)
            ->add('date', DateType::class)
            ->add('location', TextType::class)
            ->add('maxusers', IntegerType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Lesson::class,
        ));
    }
}