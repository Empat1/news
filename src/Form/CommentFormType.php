<?php

namespace App\Form;

use App\Entity\Comment;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text', TextareaType::class, [
                'label_attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Напишите комментарий:',
                'attr' => [
                    'cols' => '5',
                    'rows' => '5',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Введите пароль.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Комментарий должен состоять из минимум {{ limit }} символов',
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
            'data_class' => Comment::class,
        ]);
    }
}
