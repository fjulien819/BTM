<?php

namespace App\Form;

use App\Entity\Post;
use App\Form\Type\TagsInputType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content', ckeditorType::class)
            ->add('tags', TagsInputType::class,
        [
            'required' => false,
            'help' => 'Les tags doivent être séparés par des virgules',

        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
