<?php

namespace App\Form;

use App\Entity\News;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class NewsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label_attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Заголовок новости:',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Название новости должно состоять из минимум {{ limit }} символов',
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('annotation', TextType::class, [
                'label_attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Аннотация новости:',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль.',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Аннотация новости должна состоять из минимум {{ limit }} символов',
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('text', TextareaType::class, [
                'label_attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Текст новости:',
                'attr' => [
                    'cols' => '5',
                    'rows' => '5',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль.',
                    ]),
                    new Length([
                        'min' => 50,
                        'minMessage' => 'Новость должна состоять из минимум {{ limit }} символов',
                        'max' => 4096,
                    ]),
                ]

            ])
            ->add('submit', SubmitType::class, ['label' => 'Отправить'])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => News::class,
        ]);
    }
}
