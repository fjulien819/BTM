<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastName', TextType::class, [
                'label' => 'Votre nom',
                'attr' => ['placeholder' => 'Votre nom']
            ])
            ->add('name', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => ['placeholder' => 'Votre prénom']
            ])
            ->add('email', EmailType::class,[
                'label' => 'Votre mail',
                'attr' => ['placeholder' => 'Votre mail']
            ])
            ->add('object', ChoiceType::class, [
                'label' => 'Objet du message',
                'placeholder' => 'Choisissez le sujet approprié',
                'choices' => [
                    Contact::OBJECT_QUOTE_CHOICE => Contact::OBJECT_QUOTE_CHOICE,
                    Contact::OBJECT_INFO_CHOICE => Contact::OBJECT_INFO_CHOICE,
                    Contact::OBJECT_OTHER_CHOICE => Contact::OBJECT_OTHER_CHOICE
            ]])
            ->add('message', TextareaType::class,[
                'attr' => ['placeholder' => 'Ecrivez votre texte ici...']
            ])
            ->add('rgpd', CheckboxType::class, [
                'label' => 'En soumettant ce formulaire, j’accepte que les informations saisies soient exploitées dans le cadre de la demande de contact ou de devis, ainsi que de la relation commerciale qui peut en découler.'
            ])

            ->add('offer', HiddenType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
