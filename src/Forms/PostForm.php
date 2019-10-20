<?php


namespace App\Forms;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
$x=0;
        $builder
            ->add('title', TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'id' => 'ttl',
                        'placeholder' => 'Add title for this post',
                        'value' => ''
                    ],
                    'row_attr' => [
                        'class' => 'form-group'
                    ]
                ]
            )
            ->add('content', TextareaType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                        'id' => 'cntnt',
                        'placeholder' => 'Add content for this post',
                    ],
                    'row_attr' => [
                        'class' => 'form-group'
                    ]
                ]
            )
            ->add('save', SubmitType::class,
                [
                    'attr' => [
                        'class' => 'btn btn-primary',
                    ],
                    'row_attr' => [
                        'class' => 'form-group'
                    ]
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => Post::class
            ]
        );
    }
}