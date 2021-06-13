<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Mime\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,[
                
                'constraints'=>[new NotBlank(['message'=>'Merci de saisir une adresse email'])],
                'required'=> true,
                'attr'=>['class' =>'form-contol'],
                'attr'=> array(  'placeholder' => 'Email')
            ])
            ->add('roles', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => [
                  'User' => 'ROLE_USER',
                 
                  'Admin' => 'ROLE_ADMIN',
                ],
            ])
            ->add('password',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Password')))
            ->add('Service',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Service')))
            ->add('Nom',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Full Name')))
            ->add('Prenom',TextType::class, array(

                'attr'=> array(  'placeholder' => 'Last Name')))
        ;

        $builder->get('roles')
        ->addModelTransformer(new CallbackTransformer(
            function ($rolesArray) {
                 // transform the array to a string
                 return count($rolesArray)? $rolesArray[0]: null;
            },
            function ($rolesString) {
                 // transform the string back to an array
                 return [$rolesString];
            }
    ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
