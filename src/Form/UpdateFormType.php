<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserPosition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UpdateFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        // Consider moving this big form as SubscriberEvents? if there's more time (running low on it)
        $builder
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an username',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Email has to contain at least {{ limit }} characters',
                        'max' => 254,
                        'maxMessage' => 'Email can contain max {{ limit }} characters'
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Email has to contain at least {{ limit }} characters',
                        'max' => 254,
                        'maxMessage' => 'Email can contain max {{ limit }} characters'
                    ]),
                ],
            ])
            ->add('firstName', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a first name',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'First name has to contain at least {{ limit }} characters',
                        'max' => 254,
                        'maxMessage' => 'First name can contain max {{ limit }} characters'
                    ]),
                ],
            ])
            ->add('lastName', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a last name',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Last name has to contain at least {{ limit }} characters',
                        'max' => 254,
                        'maxMessage' => 'Last name can contain max {{ limit }} characters'
                    ]),
                ],
            ])
            ->add('description', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'Description can contain max {{ limit }} characters'
                    ]),
                ],
                'empty_data' => '',
                'required' => false,
            ])
            ->add('idPosition', EntityType::class, [
                'class' => UserPosition::class,
                // 'label' => 'Position',
            ])
            ->add('testingSystems', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'Testing systems can contain max {{ limit }} characters'
                    ]),
                ],
                'empty_data' => '',
                'required' => false,
            ])
            ->add('raportingSystems', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'Raporting systems can contain max {{ limit }} characters'
                    ]),
                ],
                'empty_data' => '',
                'required' => false,
            ])
            ->add('selenium', CheckboxType::class, [
                'required' => false,
            ])
            ->add('ideEnvironments', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'IDE environments can contain max {{ limit }} characters'
                    ]),
                ],
                'empty_data' => '',
                'required' => false,
            ])
            ->add('programmingLanguages', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'Programming languagess can contain max {{ limit }} characters'
                    ]),
                ],
                'empty_data' => '',
                'required' => false,
            ])
            ->add('mysql', CheckboxType::class, [
                'required' => false,
            ])
            ->add('methodologies', TextType::class, [
                'constraints' => [
                    new Length([
                        'max' => 254,
                        'maxMessage' => 'Methodologies can contain max {{ limit }} characters'
                    ]),
                ],
                'empty_data' => '',
                'required' => false,
            ])
            ->add('scrum', CheckboxType::class, [
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false //added for the sake of dev version
        ]);
    }

}
